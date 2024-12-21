<?php

include_once "Common.php";

class Post extends Common{

    protected $pdo;
    
    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    public function postStallholder($body){
        $result = $this->postData("stallholder_tbl", $body, $this->pdo);
        if($result['code'] == 200){
          $this->logger(" hozwe", " POST", " Created a new stallholder record");
          return $this->generateResponse($result['data'], "success", "Successfully created a new stallholder.", $result['code']);
        }
        $this->logger(" hozwe", " POST", $result['errmsg']);
        return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }

    public function postStall($body){
        $result = $this->postData("stall_tbl", $body, $this->pdo);
        if($result['code'] == 200){
          $this->logger(" hozwe", " POST", " Created a new stall record");
          return $this->generateResponse($result['data'], "success", "Successfully created a new stall.", $result['code']);
        }
        $this->logger(" hozwe", " POST", $result['errmsg']);
        return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }

    public function postReservation($body){
        $result = $this->postData("reservation_tbl", $body, $this->pdo);
        if($result['code'] == 200){
          $this->logger(" hozwe", " POST", " Created a new reservation record");
          return $this->generateResponse($result['data'], "success", "Successfully created a new reservation.", $result['code']);
        }
        $this->logger(" hozwe", " POST", $result['errmsg']);
        return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }

    public function postTransaction($body){
        $result = $this->postData("transaction_tbl", $body, $this->pdo);
        if($result['code'] == 200){
          $this->logger(" hozwe", " POST", " Created a new transaction record");
          return $this->generateResponse($result['data'], "success", "Successfully created a new transaction.", $result['code']);
        }
        $this->logger(" hozwe", " POST", $result['errmsg']);
        return $this->generateResponse(null, "failed", $result['errmsg'], $result['code']);
    }

    

}

?>