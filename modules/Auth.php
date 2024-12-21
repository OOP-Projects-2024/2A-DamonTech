<?php

include_once "Common.php";
class Authentication
{

    protected $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function isAuthorized()
    {
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);
        return $this->getToken() === $headers['authorization'];
    }

    private function getToken()
    {
        $headers = array_change_key_case(getallheaders(), CASE_LOWER);

        $sqlString = "SELECT Token FROM account_tbl WHERE Username=?";
        try {
            $stmt = $this->pdo->prepare($sqlString);
            $stmt->execute([$headers['x-auth-user']]);
            $result = $stmt->fetchAll()[0];
            return $result['Token'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return "";
    }

    private function generateHeader()
    {
        $header = [
            "typ" => "JWT",
            "alg" => "HS256",
            "app" => "Market Stall Reservation Management System"
        ];
        return base64_encode(json_encode($header));
    }

    static function decryptToken($token)
    {
    
        $tokenParts = explode('.', $token);

        if (count($tokenParts) !== 3) {
            throw new Exception('Invalid token format.');
        }

       
        $header = $tokenParts[0];
        $payload = $tokenParts[1];
        $signature = base64_decode($tokenParts[2]);

        
        $recreatedSignature = hash_hmac("sha256", "$header.$payload", TOKEN_KEY);

       
        if ($signature !== $recreatedSignature) {
            throw new Exception('Invalid token signature.');
        }

        
        $decodedPayload = base64_decode($payload);
        $userData = json_decode($decodedPayload, true);

        if (!$userData) {
            throw new Exception('Invalid token payload.');
        }

        return $userData;
    }

    private function generatePayload($id, $username)
    {
        $payload = [
            "user_id" => $id,
            "username" => $username,
        ];
        return base64_encode(json_encode($payload));
    }

    private function generateToken($id, $username)
    {
        $header = $this->generateHeader();
        $payload = $this->generatePayload($id, $username);
        $signature = hash_hmac("sha256", "$header.$payload", TOKEN_KEY);
        return "$header.$payload." . base64_encode($signature);
    }
    private function isSamePassword($inputPassword, $existingHash)
    {
        $hash = crypt($inputPassword, $existingHash);
        // $hash= $this->encryptPassword($inputPassword); //Encrypt password
        // var_dump($hash);
        // var_dump($existingHash);
        return $hash === $existingHash;
    }

    private function encryptPassword($password)
    {
        $hashFormat = "$2y$10$";
        $saltLength = 22;
        $salt = $this->generateSalt($saltLength);
        return crypt($password, $hashFormat . $salt);
    }

    private function generateSalt($length)
    {
        $urs = md5(uniqid(mt_rand(), true));
        $b64String = base64_encode($urs);
        $mb64String = str_replace("+", ".", $b64String);
        return substr($mb64String, 0, $length);
    }
    public function saveToken($token, $username)
    {

        $errmsg = "";
        $code = 0;

        try {
            $sqlString = "UPDATE account_tbl SET Token=? WHERE Username = ?";
            $sql = $this->pdo->prepare($sqlString);
            $sql->execute([$token, $username]);

            $code = 200;
            $data = null;

            return array("data" => $data, "code" => $code);
        } catch (\PDOException $e) {
            $errmsg = $e->getMessage();
            $code = 400;
        }


        return array("errmsg" => $errmsg, "code" => $code);
    }

    public function login($body)
    {
        #   ->   =   - >
        $username = $body['Username'] ?? null;
        $password = $body["Password"] ?? null;

        $code = 0;
        $payload = "";
        $remarks = "";
        $message = "";

        try {
            $sqlString = "SELECT Username, Password, Token FROM account_tbl WHERE Username = ?";
            $stmt = $this->pdo->prepare($sqlString);
            $stmt->execute([$username]);

            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetchAll()[0];
                if ($this->isSamePassword($password, $result['Password'])) {
                    $code = 200;
                    $remarks = "Success";
                    $message = "Logged in successfully";

                    session_start();
                    session_regenerate_id(true);
                   // $_SESSION['StallholderID'] = $result['StallholderID'];
                    $_SESSION['Username'] = $result['Username'];
                    $payload = array("result" => $result);

                    $token = $result["Token"];
                    $common = new Common($this->pdo);
                    $isAdmin = $common->isUserAdmin($token);
        
                } else {
                    $code = 401;
                    $payload = null;
                    $remarks = "Failed";
                    $message = "Incorrect Password.";
                }
            } else {
                $code = 401;
                $payload = null;
                $remarks = "Failed";
                $message = "Username does not exist.";
            }
        } catch (\PDOException $e) {
            $message = $e->getMessage();
            $remarks = "Failed";
            $code = 400;
        }
        return array("payload" => $payload, "remarks" => $remarks, "message" => $message, "code" => $code);
    }


    public function addAccount($body)
    {
        $errmsg = "";
        $code = 0;

        //on off for addaccount or gethashpassword
        $password = $this->encryptPassword($body["Password"]); //Encrypt password
        $username = $body["Username"]; 



        try {
            $sqlString = "INSERT INTO account_tbl ( Username, Password, Roles) VALUES (:Username, :Password, :Roles)";
            $sql = $this->pdo->prepare($sqlString);
            $sql->execute(
                array(
                    "Username" => $username,
                    "Password" => $password,
                    "Roles" => 2
                )
            );
            $code = 200;
            $data = null;

            $accountID = $this->pdo->lastInsertId();
            $token = $this->generateToken($accountID, $username);

            $updateSqlString = "UPDATE account_tbl SET Token = :Token WHERE AccountID = :AccountID";
            $sql = $this->pdo->prepare($updateSqlString);
            $sql->execute(
                array(
                    "Token" => $token,
                    "AccountID" => $accountID
                )
            );



            return array("data" => $data, "code" => $code);
        } catch (\PDOException $e) {
            $errmsg = $e->getMessage();
            $code = 400;
        }

        return array("errmsg" => $errmsg, "code" => $code);
    }
}
