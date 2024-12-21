<?php

include_once "Common.php";

class Get extends Common{

    protected $pdo;
    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    public function getLogs($date){
        $filename = "./logs/" . $date . ".log";

    $logs = array();
        try{
            $file = new SplFileObject($filename);
            while(!$file->eof()){
                array_push($logs, $file->fgets());
            }
            $remarks = "success";
            $message = "Successfully retrieved logs.";
        }
        catch(Exception $e){
            $remarks = "failed";
            $message = $e->getMessage();
        }

    return $this->generateResponse(array("logs"=>$logs), $remarks, $message, 200);
    }

    public function getStallholder($id){
        
        $condition = "isActive = 0";
        if($id != null){
            $condition .= " AND StallholderID=" . $id; 
        }

        $result = $this->getDataByTable('stallholder_tbl', $condition, $this->pdo);
        if($result['code'] == 200){
            $this->logger(" hozwe", " GET", " Retrieved a new stall record");
            return $this->generateResponse($result['data'], "success", "Successfully retrieved records.", $result['code']);
        }
        $this->logger(" hozwe", " GET", $result['errmsg']);
        return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }

    public function getStall($id) {
        
        $common = new Common($this->pdo);  
        
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $token = $headers['authorization'];
    
        if ($common->isUserAdmin($token)) {
            var_dump('admin');
            $condition = "isAvailable = 0 OR isAvailable = 1";  
        } else {
            var_dump('stallholder');
            return $this->generateResponse(null, "failed", "Access Denied: Stallholders do not have permission to get stalls.", 403);
        }
    
    
        if ($id != null) {
            $condition .= " AND StallID=" . $id; 
        }
    
        $result = $this->getDataByTable('stall_tbl', $condition, $this->pdo);
    
      
        if ($result['code'] == 200) {
            $this->logger("hozwe", "GET", "Retrieved a new stall record");
            return $this->generateResponse($result['data'], "success", "Successfully retrieved records.", $result['code']);
        }
        $this->logger("hozwe", "GET", $result['errmsg']);
        return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }
    
    
    
    public function getStallAvailable($id){
        
        $condition = "isAvailable = 0";
        if($id != null){
            $condition .= " AND StallID=" . $id; 
        }

        $result = $this->getDataByTable('stall_tbl', $condition, $this->pdo);
        if($result['code'] == 200){
            $this->logger(" hozwe", " GET", " Retrieved a new stall record");
            return $this->generateResponse($result['data'], "success", "Successfully retrieved records.", $result['code']);
        }
        $this->logger(" hozwe", " GET", $result['errmsg']);
        return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);

    }

    public function getStallOccupied($id){
        
        $condition = "isAvailable = 0 OR isAvailable = 1";
        if($id != null){
            $condition .= " AND StallID=" . $id; 
        }
        $condition = "isAvailable = 1";
        if($id != null){
            $condition .= " AND StallID=" . $id; 
        }

        $result = $this->getDataByTable('stall_tbl', $condition, $this->pdo);
        if($result['code'] == 200){
            $this->logger(" hozwe", " GET", " Retrieved a stall records");
            return $this->generateResponse($result['data'], "success", "Successfully retrieved records.", $result['code']);
        }
        $this->logger(" hozwe", " GET", $result['errmsg']);
        return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }
    
    public function getOngoingReservation($id) {
        
        $common = new Common($this->pdo);  
       
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $token = $headers['authorization'];
    
        if ($common->isUserAdmin($token)) {
            var_dump('admin');
            $condition = "ReservationStatus = 0";

        } else {
            var_dump('stallholder');
            return $this->generateResponse(null, "failed", "Access Denied: Stallholders do not have permission to get ongoing reservations.", 403);
        }
    
        if ($id != null) {
            $condition .= " AND ReservationID=" . $id; 
        }
    
        $result = $this->getDataByTable('reservation_tbl', $condition, $this->pdo);
    
      
        if ($result['code'] == 200) {
            $this->logger("hozwe", "GET", "Retrieved an ongoing reservation record");
            return $this->generateResponse($result['data'], "success", "Successfully retrieved records.", $result['code']);
        }

        $this->logger("hozwe", "GET", $result['errmsg']);
        return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }
    
    public function getCancelledReservation($id){
        $common = new Common($this->pdo);  
       
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $token = $headers['authorization'];
    
        if ($common->isUserAdmin($token)) {
            var_dump('admin');
            $condition = "ReservationStatus = 1";

        } else {
            var_dump('stallholder');
            return $this->generateResponse(null, "failed", "Access Denied: Stallholders do not have permission to get cancelled reservations.", 403);
        }
    
        if ($id != null) {
            $condition .= " AND ReservationID=" . $id; 
        }
    
        $result = $this->getDataByTable('reservation_tbl', $condition, $this->pdo);
    
      
        if ($result['code'] == 200) {
            $this->logger("hozwe", "GET", "Retrieved a cancelled reservations record");
            return $this->generateResponse($result['data'], "success", "Successfully retrieved records.", $result['code']);
        }

        $this->logger("hozwe", "GET", $result['errmsg']);
        return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }

    public function getPendingReservation($id){
        $common = new Common($this->pdo);  
       
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $token = $headers['authorization'];
    
        if ($common->isUserAdmin($token)) {
            var_dump('admin');
            $condition = "ReservationStatus = 2";

        } else {
            var_dump('stallholder');
            return $this->generateResponse(null, "failed", "Access Denied: Stallholders do not have permission to get pending reservations.", 403);
        }

        if($id != null){
            $condition .= " AND ReservationID=" . $id; 
        }
        $result = $this->getDataByTable('reservation_tbl', $condition, $this->pdo);
        if($result['code'] == 200){
            $this->logger(" hozwe", " GET", " Retrieved a pending reservation record");
            return $this->generateResponse($result['data'], "success", "Successfully retrieved records.", $result['code']);
        }
        $this->logger(" hozwe", " GET", $result['errmsg']);
        return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }

    public function getTransaction($id){
        $common = new Common($this->pdo);  
       
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $token = $headers['authorization'];
    
        if ($common->isUserAdmin($token)) {
            var_dump('admin');
            $condition = "Status = 0";

        } else {
            var_dump('stallholder');
            return $this->generateResponse(null, "failed", "Access Denied: Stallholders do not have permission to view transaction details.", 403);
        }

        $condition = "Status = 0";
        if($id != null){
            $condition .= " AND TransactionID=" . $id; 
        }

        $result = $this->getDataByTable('transaction_tbl', $condition, $this->pdo);
        if($result['code'] == 200){
            $this->logger(" hozwe", " GET", " Retrieved a transaction record");
            return $this->generateResponse($result['data'], "success", "Successfully retrieved records.", $result['code']);
        }
        $this->logger(" hozwe", " GET", $result['errmsg']);
        return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }

    public function getAccount($id = null){
        $common = new Common($this->pdo);  
       
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        $token = $headers['authorization'];
    
        if ($common->isUserAdmin($token)) {
            var_dump('admin');
            $condition = "ReservationStatus = 1";

        } else {
            var_dump('stallholder');
            return $this->generateResponse(null, "failed", "Access Denied: Stallholders do not have permission to view account details.", 403);
        }

        $sqlString = "SELECT * FROM account_tbl";
        if($id != null){
            $sqlString .= " WHERE AccountID=" . $id; 
        }
        $data = array();
        $errmsg = "";
        $code = 0;
        
        try{
            if($result = $this->pdo->query($sqlString)->fetchAll()){
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

    
    
    
}

?>