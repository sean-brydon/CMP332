<?php


require_once('../DB.php');

class UserGateway
{
    private $_dbConnection;

    public function __construct()
    {
        $this->_dbConnection = DB::connectReadDB();
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

    public function findOne(): User{

        $query = $this->_dbConnection->prepare("SELECT id,username,email,password,DATE_FORMAT(createdAt,'%Y-%m-%d') as 'createdAt', DATE_FORMAT(updatedAt,'%Y-%m-%d') as 'updatedAt' from user WHERE username=?");
        $result = $query->fetchAll()[0];
        //return a single user
        return new User($result['id'], $result['username'], $result['email'], $result['password'], $result['createdAt'], $result['updatedAt']); 
    }


}
