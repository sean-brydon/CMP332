<?php

class User
{
    private int $_id;
    private string $_username;
    private string $_email;
    private string $_password;
    private string $_createdAt;
    private string $_updatedAt;

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
        $this->_id = self::setId($_id)->_id;
        $this->_username = self::setUsername($_username)->_username;
        $this->_email = self::setEmail($_email)->_email;
        $this->_password = self::setPassword($_password)->_password;
        // Set created at to the date and time the model is created
        // TODO - validate date
        $this->_createdAt = $_createdAt == null ? date('Y-m-d H:i:s') : $_createdAt;
        // Set updated at to the date and time the model is created - as this will be the value
        // TODO - validate date
        $this->_updatedAt = $_updatedAt == null ? date('Y-m-d H:i:s') : $_updatedAt;
    }

    /**
     * /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     * @return User
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @param mixed $username
     * @return User
     * @throws ValidationException
     */
    public function setUsername($username)
    {
        if ($username === null || (strlen($username) > 5 && strlen($username) < 10)) {
//            ResponseController::ErrorResponse("Validation Error on username", 403);
            throw new ValidationException($username . " does not meet the validation requirements");
        }
        $this->_username = $username;
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
        $this->_email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $password
     * @return User
     * @throws ValidationException
     */
    public function setPassword($password)
    {
        if ($password === null || (strlen($password) > 5 && strlen($password) < 15)) {
            throw new ValidationException("Password does not meet the validation requirements");
        }
        $this->_password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->_createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->_createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->_updatedAt;
    }

    /**
     * @param mixed $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->_updatedAt = $updatedAt;
        return $this;
    }


}