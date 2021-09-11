<?php
require_once('./Gateway/UserGateway.php');
require_once('./Controller/ResponseController.php');
require_once('./Helpers/Post.php');
require_once('./Helpers/Authenticator.php');
require_once('./Model/User.php');

class AuthController {
    private $_userGateway;
    private $_requestMethod;
    private $_authManager;
    public function __construct($db)
    {
        $this->_userGateway= new UserGateway($db);
        $this->_authManager= new AuthManager();
        $this->_requestMethod = $_SERVER["REQUEST_METHOD"];
    }
    
    function handleRequest(){
        if($this->_requestMethod != "POST"){
            return ResponseController::ErrorResponse("There has been an error", 500);
        }
    } 

    public function login(){
        $this->handleRequest();
        $PostBody = json_decode(file_get_contents("php://input"),true);

        if(!(isset($PostBody['username']) && isset($PostBody['password']))) return ResponseController::ErrorResponse("The body of this message is in the incorrect format.");

        $foundUser = $this->_userGateway->findOne($PostBody['username']);

        // Putting these in the same if statement would be less code but i beleive these being a guard statement makes the code more readable. 
        if(!$foundUser) return ResponseController::ErrorResponse("The username or password is incorrect");
        if($foundUser->getPassword() != $PostBody['password']) return ResponseController::ErrorResponse("The username or password is incorrect");

        $jwt = $this->_authManager->IssueJWT($foundUser);

        return ResponseController::SuccessResponse("Success",200,array($jwt),false);
    }



}