<?php


class Favourite
{
    private int $_id;
    private int $_userId;
    private int $_movieId;
    private string $_createdAt;
    private string $_updatedAt;

    /**
     * Favourite constructor.
     * @param int $_id
     * @param int $_userId
     * @param int $_movieId
     * @param string $_createdAt
     * @param string $_updatedAt
     */
    public function __construct(int $_id, int $_userId, int $_movieId, string $_updatedAt)
    {
        $this->_id = $_id;
        $this->_userId = $_userId;
        $this->_movieId = $_movieId;
        $this->_createdAt = date('Y-m-d H:i:s');
        $this->_updatedAt = $_updatedAt == null ? date('Y-m-d H:i:s') : $_updatedAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param int $id
     * @return Favourite
     */
    public function setId(int $id): Favourite
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->_userId;
    }

    /**
     * @param int $userId
     * @return Favourite
     */
    public function setUserId(int $userId): Favourite
    {
        $this->_userId = $userId;
        return $this;
    }

    /**
     * @return int
     */
    public function getMovieId(): int
    {
        return $this->_movieId;
    }

    /**
     * @param int $movieId
     * @return Favourite
     */
    public function setMovieId(int $movieId): Favourite
    {
        $this->_movieId = $movieId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->_createdAt;
    }

    /**
     * @param string $createdAt
     * @return Favourite
     */
    public function setCreatedAt(string $createdAt): Favourite
    {
        $this->_createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->_updatedAt;
    }

    /**
     * @param string $updatedAt
     * @return Favourite
     */
    public function setUpdatedAt(string $updatedAt): Favourite
    {
        $this->_updatedAt = $updatedAt;
        return $this;
    }


}