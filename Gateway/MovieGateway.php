<?php


require_once('./DB.php');
require_once('./Model/Movie.php');

class MovieGateway 
{
    private $_dbConnection;

    public function __construct()
    {
        $this->_dbConnection = DB::connectReadDB();
    }

    public function findAll(): array
    {
        $query = $this->_dbConnection->prepare("SELECT * from tblMovies");
        /* $query = $this->_dbConnection->prepare("SELECT id,title,ageRating,movieRating,releaseDate,description,genre,director,DATE_FORMAT(createdAt,'%Y-%m-%d') as 'createdAt', DATE_FORMAT(updatedAt,'%Y-%m-%d') as 'updatedAt' from tblMovies"); */
        $result = $query->fetchAll();
        $movies= array();
        array_push($movies,$result);
        /* var_dump($movies); */
        /* foreach ($result as $movie) { */
        /*     $tmpMovies= new Movie($movie['id'],$movie['title'],$movie['ageRating'],$movie['movieRating'],$movie['releaseDate'],$movie['description'],$movie['genre'],$movie['director']);  */
        /*     array_push($movies, $tmpMovies); */
        /* } */
        return $movies;
    }

  public function insertOne() {
      $sql = $this->_dbConnection->prepare("INSERT INTO `tblMovies` (`title`, `ageRating`, `movieRating`, `releaseDate`, `description`, `genre`, `director`) VALUES (:title, :ageRating, :movieRating, :releaseDate, :description, :genre,:director)");
      $title = "Test";
      $ageRating= 18;
      $movieRating= strval(4.5);
      $releaseDate= "20-12-12";
      $description= "Test";
      $genre= "Test";
      $sql->bindParam(':title',$title,PDO::PARAM_STR);
      $sql->bindParam(':ageRating',$ageRating,PDO::PARAM_INT);
      $sql->bindParam(':movieRating',$movieRating,PDO::PARAM_STR);
      $sql->bindParam(':releaseDate',$releaseDate,PDO::PARAM_STR);
      $sql->bindParam(':description',$description,PDO::PARAM_STR);
      $sql->bindParam(':genre',$genre,PDO::PARAM_STR);
      $sql->bindParam(':director',$genre,PDO::PARAM_STR);

      return $sql->execute();
  }
}
