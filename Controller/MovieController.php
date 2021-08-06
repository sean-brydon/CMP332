<?php
require_once('./Gateway/MovieGateway.php');
require_once('./Controller/ResponseController.php');

class MovieController 
{
    private $_requestMethod;
    private $_movieGateway;
    public function __construct()
    {
        $this->_requestMethod = $_SERVER["REQUEST_METHOD"];
        $this->_movieGateway = new MovieGateway();

    }

    public function handleRequest()
    {
        switch ($this->_requestMethod) {
            case 'GET':
    // TODO: Implement checking for to see if there is an id in the query array
                 
                $this->findAll(); 
                break;
            case 'POST':
                $this->insertOne(); 
                break;
            case 'PUT':
                echo('User Put');

                break;
            case 'DELETE':
                echo('User Delete');
                break;
            default:
                ResponseController::ErrorResponse("This endpoint does not take this request method");
                break;
        }
    }

    public function findAll()
    {
        try {
            $result = $this->_movieGateway->findAll();
            if (!count($result) > 0) return ResponseController::SuccessResponse('There are no movies in the database', 200, null, false);
            $returnData = array();
            echo(count($result));
            $returnData['rows_returned'] = count($result);
            $returnData['movies'] = $result;

            ResponseController::SuccessResponse("Success", 200, $returnData, true);

            // These exceptions would normally not be merged however since this is a find all - It will be a server error if one of the validations fail.
        } catch (PDOException $PDOException) {
            ResponseController::ErrorResponse("There has been an error", 500);
        }
    }

  public function insertOne()
  {
    try{
      $result = $this->_movieGateway->insertOne();
      if(!$result)return  ResponseController::ErrorResponse("There has been an error with inserting data into the database",404);

      return ResponseController::SuccessResponse("Success",200,null,false);

    }catch(PDOException $expection){
      return ResponseController::ErrorResponse($expection->getMessage(),500);
    }


  }
}
