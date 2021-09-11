<?php


require_once('./Model/Movie.php');

class MovieGateway 
{
    private $_dbConnection;

    public function __construct($db)
    {
        $this->_dbConnection = $db;
    }

    public function findAll()
    {
        // Select all from tblMovies and return results
        $sqlQuery = "SELECT * FROM tblMovies";
        $statement = $this->_dbConnection->prepare($sqlQuery);
        $statement->execute();
        $result = $statement->fetchAll();
        $movies = array();
        foreach ($result as $row) {
            $movie = new Movie($row['id'], $row['title'], $row['ageRating'], $row['movieRating'], $row['releaseDate'], $row['description'], $row['genre'], $row['director'], $row['createdAt'], $row['updatedAt']);
            array_push($movies, $movie->toArray());
        }
        return $movies;
 
    }


    // Create a function to find a movie by id
    public function find($id)
    {
        $sqlQuery = "SELECT * FROM tblMovies WHERE id = :id";
        $statement = $this->_dbConnection->prepare($sqlQuery);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch();
        // if result is empty return null
        if (empty($result)) {
            return null;
        }
        $movie = new Movie($result['id'], $result['title'], $result['ageRating'], $result['movieRating'], $result['releaseDate'], $result['description'], $result['genre'], $result['director'], $result['createdAt'], $result['updatedAt']);
        return $movie->toArray();

    }

    // create a function to insert a new movie into db from post body
    public function insert($movie)
    {
        $sqlQuery = "INSERT INTO tblMovies (title, ageRating, movieRating, releaseDate, description, genre, director) VALUES (:title, :ageRating, :movieRating, :releaseDate, :description, :genre, :director)";
        $statement = $this->_dbConnection->prepare($sqlQuery);
        $statement->bindParam(':title', $movie['title'], PDO::PARAM_STR);
        $statement->bindParam(':ageRating', $movie['ageRating'], PDO::PARAM_INT);
        $statement->bindParam(':movieRating', $movie['movieRating'], PDO::PARAM_INT);
        $statement->bindParam(':releaseDate', $movie['releaseDate'], PDO::PARAM_STR);
        $statement->bindParam(':description', $movie['description'], PDO::PARAM_STR);
        $statement->bindParam(':genre', $movie['genre'], PDO::PARAM_STR);
        $statement->bindParam(':director', $movie['director'], PDO::PARAM_STR);
        $statement->execute();
        $newVar = $this->_dbConnection->lastInsertId();
        return $this->find($newVar);
    }

    // function to update the movie that takes in ID and a movie array
    public function update($id, $movie)
    {
        $sqlQuery = "UPDATE tblMovies SET title = :title, ageRating = :ageRating, movieRating = :movieRating, releaseDate = :releaseDate, description = :description, genre = :genre, director = :director WHERE id = :id";
        $statement = $this->_dbConnection->prepare($sqlQuery);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':title', $movie['title'], PDO::PARAM_STR);
        $statement->bindParam(':ageRating', $movie['ageRating'], PDO::PARAM_INT);
        $statement->bindParam(':movieRating', $movie['movieRating'], PDO::PARAM_INT);
        $statement->bindParam(':releaseDate', $movie['releaseDate'], PDO::PARAM_STR);
        $statement->bindParam(':description', $movie['description'], PDO::PARAM_STR);
        $statement->bindParam(':genre', $movie['genre'], PDO::PARAM_STR);
        $statement->bindParam(':director', $movie['director'], PDO::PARAM_STR);
        $statement->execute();
        return $this->find($id);
    }

    // function to delete a movie by ID
    public function delete($id)
    {
        $movie = $this->find($id);
        $sqlQuery = "DELETE FROM tblMovies WHERE id = :id";
        $statement = $this->_dbConnection->prepare($sqlQuery);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        if(isset($movie)) {
            return $movie;
        }else{
            return null;
        }
    }

}
