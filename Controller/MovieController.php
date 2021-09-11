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
                if(isset($uri[3])) {
                    $this->findById($uri[3]);
                } else{
                  $this->findAll(); 
                }
                break;
            case 'POST':
                $this->insertOne($this->postDataToMovie()); 
                break;
            case 'PUT':
                $this->updateOne($uri[3],$this->postDataToMovie());

                break;
            case 'DELETE':
                $this->delete($uri[3]);
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

     public function findById($id)
    {
        try {
            $result = $this->_movieGateway->find($id);
            if (!count($result) > 0) return ResponseController::SuccessResponse('There are no movies in the database with this ID', 200, null, false);
            $returnData = array();
            $returnData['movies'] = $result;

            ResponseController::SuccessResponse("Success", 200, $returnData, true);

            // These exceptions would normally not be merged however since this is a find all - It will be a server error if one of the validations fail.
        } catch (PDOException $PDOException) {
            ResponseController::ErrorResponse("There has been an error", 500);
        }
    }

  public function insertOne($movie)
  {
    try{
      $result = $this->_movieGateway->insert($movie);
      if(!$result)return  ResponseController::ErrorResponse("There has been an error with inserting data into the database",404);

      return ResponseController::SuccessResponse("Success",200,$result,false);

    }catch(PDOException $expection){
      return ResponseController::ErrorResponse($expection->getMessage(),500);
    }
  }

  // function to update a movie
  public function updateOne($id,$movie)
  {
    try{
      $result = $this->_movieGateway->update($id,$movie);
      if(!$result) return  ResponseController::ErrorResponse("There was no movie with this ID",404);

      return ResponseController::SuccessResponse("Success",200,$result,false);


    }catch(PDOException $expection){
      return ResponseController::ErrorResponse($expection->getMessage(),500);

    }
  }

  public function delete($id)
  {
    try{
      $result = $this->_movieGateway->delete($id);
      if(!$result) return  ResponseController::ErrorResponse("There was no movie with this ID",404);
      
      return ResponseController::SuccessResponse("Success",200,$result,false);

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
