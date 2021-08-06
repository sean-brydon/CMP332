<?php

include_once('../Gateway/UserGateway.php');
class UserController
{
    private UserGateway $_userGateway;
    private $_requestMethod;

    public function __construct()
    {
//        $this->_userGateway = new UserGateway();
        $this->_requestMethod = $_SERVER["REQUEST_METHOD"];
        echo("Initialised");
    }

    public function handleRequest()
    {
        switch ($this->_requestMethod) {
            case 'GET':
                echo('User Get');
                break;
            //WIP Implement in the future
            case 'POST':
                echo('User Post');

                break;
            case 'PUT':
                echo('User Put');

                break;
            case 'DELETE':
                echo('User Delete');
                break;
            default:
                break;
        }
    }

    public function findAll()
    {
        try {
            $result = $this->_userGateway->findAll();
            // return success as query was preformed successfully but notify there are no users in the database.
            if (!count($result) > 0) ResponseController::SuccessResponse('There are no users in the database', 200, null, false);

            $returnData = array();
            $returnData['rows_returned'] = count($result);
            $returnData['users'] = $result;

            ResponseController::SuccessResponse("Success", 200, $returnData, true);

        } catch (PDOException | ValidationException $PDOException) {
            echo($PDOException);
            /* ResponseController::ErrorResponse("There has been an error", 500); */
        }
    }
}
