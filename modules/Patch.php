<?php
class Patch{

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

//PATCH
    public function patchStallholder($body, $id){
        $values = [];
        $errmsg = "";
        $code = 0;


        foreach($body as $value){
            array_push($values, $value);
        }

        array_push($values, $id);
        
        try{
            $sqlString = "UPDATE stallholder_tbl SET FirstName=?, LastName=?, StallNo=?, isActive=? WHERE StallholderID = ?";
            $sql = $this->pdo->prepare($sqlString);
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

    public function patchStallAvailable($body, $id){

        $values = [];
        $errmsg = "";
        $code = 0;


        foreach($body as $value){
            array_push($values, $value);
        }

        array_push($values, $id);
        
        try{
            $sqlString = "UPDATE stall_tbl SET StallholderID=?, StallName=?, StallNumber=?, isAvailable=? WHERE StallID = ?";
            $sql = $this->pdo->prepare($sqlString);
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
    public function patchStallOccupied($body, $id){

        $common = new Common($this->pdo);  
       
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $token = $headers['authorization'];
    
        if ($common->isUserAdmin($token)) {
            var_dump('admin');

        } else {
            var_dump('stallholder');
            return $this->generateResponse(null, "failed", "Access Denied: Stallholders do not have permission to patch occupied stall.", 403);
        }

        $values = [];
        $errmsg = "";
        $code = 0;


        foreach($body as $value){
            array_push($values, $value);
        }

        array_push($values, $id);
        
        try{
            $sqlString = "UPDATE stall_tbl SET StallholderID=?, StallName=?, StallNumber=?, isAvailable=? WHERE StallID = ?";
            $sql = $this->pdo->prepare($sqlString);
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


    public function patchOngoingReservation($body, $id){

        $common = new Common($this->pdo);  
       
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $token = $headers['authorization'];
    
        if ($common->isUserAdmin($token)) {
            var_dump('admin');

        } else {
            var_dump('stallholder');
            return $this->generateResponse(null, "failed", "Access Denied: Stallholders do not have permission to patch ongoing reservation.", 403);
        }

        $values = [];
        $errmsg = "";
        $code = 0;


        foreach($body as $value){
            array_push($values, $value);
        }

        array_push($values, $id);
        
        try{
            $sqlString = "UPDATE reservation_tbl SET StallholderID =?, StallID=?, ReservationStartDate=?, ReservationEndDate=?, ReservationStatus=? WHERE ReservationID = ?";
            $sql = $this->pdo->prepare($sqlString);
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

    public function patchCancelledReservation($body, $id){

        $common = new Common($this->pdo);  
       
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $token = $headers['authorization'];
    
        if ($common->isUserAdmin($token)) {
            var_dump('admin');

        } else {
            var_dump('stallholder');
            return $this->generateResponse(null, "failed", "Access Denied: Stallholders do not have permission to patch cancelled reservation.", 403);
        }

        $values = [];
        $errmsg = "";
        $code = 0;


        foreach($body as $value){
            array_push($values, $value);
        }

        array_push($values, $id);
        
        try{
            $sqlString = "UPDATE reservation_tbl SET StallholderID =?, StallID=?, ReservationStartDate=?, ReservationEndDate=?, ReservationStatus=? WHERE ReservationID = ?";
            $sql = $this->pdo->prepare($sqlString);
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

    public function patchPendingReservation($body, $id){

        $common = new Common($this->pdo);  
       
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $token = $headers['authorization'];
    
        if ($common->isUserAdmin($token)) {
            var_dump('admin');

        } else {
            var_dump('stallholder');
            return $this->generateResponse(null, "failed", "Access Denied: Stallholders do not have permission to patch pending reservation.", 403);
        }

        $values = [];
        $errmsg = "";
        $code = 0;


        foreach($body as $value){
            array_push($values, $value);
        }

        array_push($values, $id);
        
        try{
            $sqlString = "UPDATE reservation_tbl SET StallholderID =?, StallID=?, ReservationStartDate=?, ReservationEndDate=?, ReservationStatus=? WHERE ReservationID = ?";
            $sql = $this->pdo->prepare($sqlString);
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



//ARCHIVE
    public function archiveStallholder($id){
        
        $errmsg = "";
        $code = 0;
        
        try{
            $sqlString = "UPDATE stallholder_tbl SET isActive=1 WHERE StallholderID = ?";
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