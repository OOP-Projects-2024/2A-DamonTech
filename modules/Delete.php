<?php
class Delete{

    protected $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
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

    public function deleteStallholder($id){
        
        $common = new Common($this->pdo);  
       
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $token = $headers['authorization'];
    
        if ($common->isUserAdmin($token)) {
            var_dump('admin');

        } else {
            var_dump('stallholder');
            return $this->generateResponse(null, "failed", "Access Denied: Stallholders do not have permission to delete stallholder.", 403);
        }

        $errmsg = "";
        $code = 0;
        
        try{
            $sqlString = "DELETE FROM stallholder_tbl WHERE StallholderID = ?";
            $sql = $this->pdo->prepare($sqlString);
            $sql->execute([$id]);

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

    public function deleteStall($id){
        
        $common = new Common($this->pdo);  
       
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $token = $headers['authorization'];
    
        if ($common->isUserAdmin($token)) {
            var_dump('admin');

        } else {
            var_dump('stallholder');
            return $this->generateResponse(null, "failed", "Access Denied: Stallholders do not have permission to delete stall.", 403);
        }

        $errmsg = "";
        $code = 0;
        
        try{
            $sqlString = "DELETE FROM stall_tbl WHERE StallID = ?";
            $sql = $this->pdo->prepare($sqlString);
            $sql->execute([$id]);

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
    
    public function deleteReservation($id){
        
        $common = new Common($this->pdo);  
       
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $token = $headers['authorization'];
    
        if ($common->isUserAdmin($token)) {
            var_dump('admin');

        } else {
            var_dump('stallholder');
            return $this->generateResponse(null, "failed", "Access Denied: Stallholders do not have permission to delete reservation.", 403);
        }

        $errmsg = "";
        $code = 0;
        
        try{
            $sqlString = "DELETE FROM reservation_tbl WHERE ReservationID = ?";
            $sql = $this->pdo->prepare($sqlString);
            $sql->execute([$id]);

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

    public function deleteTransaction($id){
        
        $common = new Common($this->pdo);  
       
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $token = $headers['authorization'];
    
        if ($common->isUserAdmin($token)) {
            var_dump('admin');

        } else {
            var_dump('stallholder');
            return $this->generateResponse(null, "failed", "Access Denied: Stallholders do not have permission to delete transaction.", 403);
        }

        $errmsg = "";
        $code = 0;
        
        try{
            $sqlString = "DELETE FROM transaction_tbl WHERE TransactionID = ?";
            $sql = $this->pdo->prepare($sqlString);
            $sql->execute([$id]);

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
}

?>