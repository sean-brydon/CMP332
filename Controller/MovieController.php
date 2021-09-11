<?php
require_once('./Gateway/MovieGateway.php');


class MovieController 
{
    private $_requestMethod;
    private $_movieGateway;
    private $db;

    public function __construct($db)
    {
        $this->_requestMethod = $_SERVER["REQUEST_METHOD"];
        $this->_movieGateway = new MovieGateway($db);
        $this->db = $db;
    }

    public function handleRequest()
    {
      $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $uri = explode('/', $uri);
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
      $movie = $this->postDataToMovie();
      $result = $this->_movieGateway->insert($movie);
      if(!$result)return  ResponseController::ErrorResponse("There has been an error with inserting data into the database",404);

      return ResponseController::SuccessResponse("Success",200,null,false);

    }catch(PDOException $expection){
      return ResponseController::ErrorResponse($expection->getMessage(),500);
    }
  }

  // function to update a movie
  public function updateOne($id,$movie)
  {
    try{
      $result = $this->_movieGateway->update($id,$movie);
      if(!$result)return  ResponseController::ErrorResponse("There has been an error with updating data into the database",404);
      
    }catch(PDOException $expection){
      return ResponseController::ErrorResponse($expection->getMessage(),500);

    }
  }

  public function postDataToMovie() : array{
    $data = json_decode(file_get_contents('php://input'), true);
      // Create movie from $data
      $movie = array();
      // title, ageRating, movieRating, releaseDate, description, genre, director
      try{
        $movie['title'] = $data['title'];
        $movie['ageRating'] = $data['ageRating'];
        $movie['movieRating'] = $data['movieRating'];
        $movie['releaseDate'] = $data['releaseDate'];
        $movie['description'] = $data['description'];
        $movie['genre'] = $data['genre'];
        $movie['director'] = $data['director'];

        return $movie;
      }catch(Exception $e){
          return ResponseController::ErrorResponse("There was an error with the data sent", 400);
      }
  }
}
