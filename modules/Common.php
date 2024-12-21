

<?php

include_once "Auth.php";

class Common{

    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    

    protected function logger($user, $method, $action){
        $filename = date("Y-m-d") . ".log";
        $datetime = date("Y-m-d H:i:s");
        $logMessage = "$datetime,$method,$user,$action" . PHP_EOL;
        file_put_contents("./logs/$filename", $logMessage, FILE_APPEND | LOCK_EX);
    }

    private function generateInsertString($tablename, $body){
        $keys = array_keys($body);
        $fields = implode(",", $keys);
        $parameter_array = [];
        for($i = 0; $i < count($keys); $i++){
            $parameter_array[$i] = "?";
        }
        $parameters = implode(',', $parameter_array);
        $sql = "INSERT INTO $tablename($fields) VALUES ($parameters)";
        return $sql;
    }

    public function getDataByTable($tableName, $condition, \PDO $pdo){
        $sqlString = "SELECT * FROM $tableName WHERE $condition";
        $data = array();
        $errmsg = "";
        $code = 0;

        
        try{
            if($result = $pdo->query($sqlString)->fetchAll()){
                foreach($result as $record){
                    array_push($data, $record);
                }
                $result = null;
                $code = 200;
                return array("code"=>$code, "data"=>$data); 
            }
            else{
                $errmsg = "No data found";
                $code = 404;
            }
        }
        catch(\PDOException $e){
            $errmsg = $e->getMessage();
            $code = 403;
        }

        return array("code"=>$code, "errmsg"=>$errmsg);
    }

    protected function getDataBySQL($sqlString, \PDO $pdo){
        $data = array();
        $errmsg = "";
        $code = 0;

        
        try{
            if($result = $pdo->query($sqlString)->fetchAll()){
                foreach($result as $record){
                    array_push($data, $record);
                }
                $result = null;
                $code = 200;
                return array("code"=>$code, "data"=>$data); 
            }
            else{
                $errmsg = "No data found";
                $code = 404;
            }
        }
        catch(\PDOException $e){
            $errmsg = $e->getMessage();
            $code = 403;
        }

        return array("code"=>$code, "errmsg"=>$errmsg);
    }


    protected function generateResponse($data, $remark, $message, $statusCode){
        $status = array(
            "remark" => $remark,
            "message" => $message
        );

        http_response_code($statusCode);

        return array(
            "payload" => $data,
            "status" => $status,
            "prepared_by" => "blahblah", 
            "date_generated" => date_create()
        );
    }

    public function postData($tableName, $body, \PDO $pdo){
        $values = [];
        $errmsg = "";
        $code = 0;


        foreach($body as $value){
            array_push($values, $value);
        }
        
        try{
            $sqlString = $this->generateInsertString($tableName, $body);
            $sql = $pdo->prepare($sqlString);
            $sql->execute($values);

            $code = 200;
            $data = null;

            return array("data"=>$data, "code"=>$code);
        }
        catch(\PDOException $e){
            $errmsg = $e->getMessage();
            $code = 400;
        }

        
        return array("errmsg"=>$errmsg, "code"=>$code);

    }

    public function isUserAdmin($token){

        $user = Authentication::decryptToken($token);
        
        $user_id = $user["user_id"];

        $sqlString = "SELECT * FROM account_tbl WHERE AccountID = :AccountID";
        $stmt = $this->pdo->prepare($sqlString);
        $result = $stmt->execute(array(
            "AccountID" => $user_id
        ));
        $result = $stmt->fetchAll()[0];

        if($result["Roles"] == 1){
            return true;
        }

        return false; // if not authorized
    }
    public function getStallholderIDFromToken($token) {
        $decoded = $this->decodeJWT($token); 

        if ($decoded && isset($decoded['role']) && $decoded['role'] === 'stallholder') {
            return $decoded['stallholderID'];
        }

        return null;
    }

    private function decodeJWT($token){}
} 





?>