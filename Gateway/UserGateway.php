<?php

class UserGateway
{
    private $_dbConnection;

    public function __construct($db)
    {
        $this->_dbConnection = $db;
    }

    /**
     * @throws ValidationException
     */
    public function findAll(): array
    {
        $query = $this->_dbConnection->prepare("SELECT id,username,email,password,DATE_FORMAT(createdAt,'%Y-%m-%d') as 'createdAt', DATE_FORMAT(updatedAt,'%Y-%m-%d') as 'updatedAt' from user");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $users = array();
        foreach ($result as $user) {
            $tmpUser = new User($user['id'], $user['username'], $user['email'], $user['password'], $user['createdAt'], $user['updatedAt']);
            array_push($users, $tmpUser);
        }
        return $users;
    }

    public function findOne($username){

        $sqlQuery = "SELECT id,username,email,password,DATE_FORMAT(createdAt,'%Y-%m-%d') as 'createdAt', DATE_FORMAT(updatedAt,'%Y-%m-%d') as 'updatedAt'  FROM user WHERE username = :username";
        $statement = $this->_dbConnection->prepare($sqlQuery);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetch();
        // if result is empty return null
        if (empty($result)) {
            return null;
        }
        return new User($result['id'], $result['username'], $result['email'], $result['password'], $result['createdAt'], $result['updatedAt']); 
    }
    
    public function findOneById($id){

        $sqlQuery = "SELECT * FROM users WHERE id = :id";
        $statement = $this->_dbConnection->prepare($sqlQuery);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch();
        // if result is empty return null
        if (empty($result)) {
            return null;
        }
        return new User($result['id'], $result['username'], $result['email'], $result['password'], $result['createdAt'], $result['updatedAt']); 
    }

}
