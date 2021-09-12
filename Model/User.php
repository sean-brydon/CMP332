<?php

class User
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $createdAt;
    private string $updatedAt;
    /**
     * User constructor.
     * @param $_id
     * @param $_username
     * @param $_email
     * @param $_password
     * @param $_updatedAt
     * @throws ValidationException
     */
    public function __construct($_id, $_username, $_email, $_password, $_createdAt = null, $_updatedAt = null)
    {
        // Using fluid setters to allow us to easily build the User in future code.
        $this->id = $_id;
        $this->username =$_username;
        $this->email = $_email;
        $this->password =$_password;
        // Set created at to the date and time the model is created
        $this->createdAt = $_createdAt == null ? date('Y-m-d H:i:s') : $_createdAt;
        // Set updated at to the date and time the model is created - as this will be the value
        $this->updatedAt = $_updatedAt == null ? date('Y-m-d H:i:s') : $_updatedAt;
    }

    /**
     * /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return User
     * @throws ValidationException
     */
    public function setUsername($username)
    {
        if ($username === null || (strlen($username) > 5 && strlen($username) < 4)) {
            throw new ValidationException($username . " does not meet the validation requirements");
        }
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     * @return User
     * @throws ValidationException
     */
    public function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException($email . " does not meet the validation requirements");
        }
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return User
     * @throws ValidationException
     */
    public function setPassword($password)
    {
        if ($password === null || (strlen($password) > 5 && strlen($password) < 5)) {
            throw new ValidationException("Password does not meet the validation requirements");
        }
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


}