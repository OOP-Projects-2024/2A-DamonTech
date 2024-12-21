<?php

require_once "./config/database.php";
require_once "./modules/Get.php";
require_once "./modules/Post.php";
require_once "./modules/Patch.php";
require_once "./modules/Delete.php";
require_once "./modules/Auth.php";
require_once "./modules/Crypt.php";

$db = new Connection();
$pdo = $db->connect();

$post = new Post($pdo);
$get = new Get($pdo);
$delete = new Delete($pdo);
$patch = new Patch($pdo);
$auth = new Authentication($pdo);
$crypt = new Crypt();

if(isset($_REQUEST['request'])){
    $request = explode("/", $_REQUEST['request']);
}
else{
    echo "URL does not exist.";
}

switch($_SERVER['REQUEST_METHOD']){

    case "GET":

        if($auth->isAuthorized()){
            switch($request[0]){
    
                case "account":
                    if(count($request) > 1){
                        echo json_encode($get->getAccount($request[1]));
                    }
                    else{
                        echo json_encode($get->getAccount());
                    }
                break;

                case "stall":
                    echo json_encode($get->getStall($request[1] ?? null));
                break;

                case "stallavailable":
                    echo json_encode($get->getStallAvailable($request[1] ?? null));
                break;

                case "stalloccupied":
                    echo json_encode($get->getStallOccupied($request[1] ?? null));
                break;
    
                case "ongoingreservation":
                    echo json_encode($get->getOngoingReservation($request[1] ?? null));
                break;

                case "pendingreservation":
                    echo json_encode($get->getPendingReservation($request[1] ?? null));
                break;

                case "cancelledreservation":
                    echo json_encode($get->getCancelledReservation($request[1] ?? null));
                break;
                
                case "stallholder": //encrypted get
                    $dataString = json_encode($get->getStallholder($request[1] ?? null));
                    echo $crypt->encryptData($dataString);
                    break;
                                 

                case "transaction":
                    echo json_encode($get->getTransaction($request[1] ?? null));
                break;

                case "log":
                    echo json_encode($get->getLogs($request[1] ?? date("Y-m-d")));
                break;
    
                default:
                    http_response_code(401);
                    echo "This is invalid endpoint";
                break;
           
            }
        }
        else{
            http_response_code(401);
            echo "Unauthorized";
        }

    break;
    
    case "POST":
        $body = json_decode(file_get_contents("php://input"),true);
        switch($request[0]){
            
            case "login":
              echo json_encode($auth->login($body));
            break;

            case "account":
                echo json_encode($auth->addAccount($body));
            break;

            case "stallholder":
                //for adding of stallholder
                echo json_encode($post->postStallholder($body));
                
                //for decrypting of stallholder data
                //echo $crypt->decryptData($body);
            break;

            case "stall":
                echo json_encode($post->postStall($body));
            break;

            case "reservation":
                echo json_encode($post->postReservation($body));
            break;

            case "transaction":
                echo json_encode($post->postTransaction($body));
            break;

            default:
                http_response_code(401);
                echo "This is invalid endpoint";
            break;
        }
    break;

    case "PATCH":
        $body = json_decode(file_get_contents("php://input"));

        switch($request[0]){
            case "stallholder":
                echo json_encode($patch->patchStallholder($body, $request[1]));
            break;
            
            case "stallavailable":
                echo json_encode($patch->patchStallAvailable($body, $request[1]));
            break;
           
            case "stalloccupied":
                echo json_encode($patch->patchStallOccupied($body, $request[1]));
            break;

            case "ongoingreservation":
                echo json_encode($patch->patchOngoingReservation($body, $request[1]));
            break;

            case "cancelledreservation":
                echo json_encode($patch->patchCancelledReservation($body, $request[1]));
            break;

            case "pendingreservation":
                echo json_encode($patch->patchPendingReservation($body, $request[1]));
            break;

        }
        break;
        
    case "DELETE":
            switch($request[0]){
                case "destroystallholder":
                    echo json_encode($delete->deleteStallholder($request[1]));
                    break;
                case "destroystall":
                    echo json_encode($delete->deleteStall($request[1]));
                    break;
                }
        break;

    default:
        http_response_code(400);
        echo "Invalid Request Method.";
    break;

}

$pdo = null;

?>
