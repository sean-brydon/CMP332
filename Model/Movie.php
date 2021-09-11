<?php


class Movie
{
    public int $id;
    public string $title;
    public int $ageRating;
    public float $movieRating;
    public string $releaseDate;
    public string $description;
    public string $genre;
    public string $director;

    // This is the main constutor used when fetching
    /**
     * Movie constructor.
     * @param int $id
     * @param string $_title
     * @param int $_ageRating
     * @param float $_movieRating
     * @param string $_releaseDate
     * @param string $_description
     * @param string $_genre
     * @param string $_director
     */
    public function __construct(int $_id, string $_title, int $_ageRating, float $_movieRating, string $_releaseDate, string $_description, string $_genre, string $_director,string $createdAt = null, string $updatedAt = null)
    {
        // Using fluent setters to allow us to easily create the class in future code.
        // We use the setters when creating the class to ensure all values are validated correctly.
        $this->id = $_id;
        $this->title = $_title;
        $this->ageRating = $_ageRating;
        $this->movieRating = $_movieRating;
        $this->releaseDate = $_releaseDate;
        $this->description = $_description;
        $this->genre = $_genre;
        $this->director = $_director;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

// Function to turn this class into an array.
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'ageRating' => $this->ageRating,
            'movieRating' => $this->movieRating,
            'releaseDate' => $this->releaseDate,
            'description' => $this->description,
            'genre' => $this->genre,
            'director' => $this->director,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
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
     * @return Movie
     */
    public function setId(int $id): Movie
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->_title;
    }

    /**
     * @param string $title
     * @return Movie
     */
    public function setTitle(string $title): Movie
    {
        $this->_title = $title;
        return $this;
    }

    /**
     * @return int
     */
    public function getAgeRating(): int
    {
        return $this->_ageRating;
    }

    /**
     * @param int $ageRating
     * @return Movie
     */
    public function setAgeRating(int $ageRating): Movie
    {
        $this->_ageRating = $ageRating;
        return $this;
    }

    /**
     * @return float
     */
    public function getMovieRating(): float
    {
        return $this->_movieRating;
    }

    /**
     * @param float $movieRating
     * @return Movie
     */
    public function setMovieRating(float $movieRating): Movie
    {
        $this->_movieRating = $movieRating;
        return $this;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->_releaseDate;
    }

    /**
     * @param string $releaseDate
     * @return Movie
     */
    public function setReleaseDate(string $releaseDate): Movie
    {
        $this->_releaseDate = $releaseDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->_description;
    }

    /**
     * @param string $description
     * @return Movie
     */
    public function setDescription(string $description): Movie
    {
        $this->_description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getGenre(): string
    {
        return $this->_genre;
    }

    /**
     * @param string $genre
     * @return Movie
     */
    public function setGenre(string $genre): Movie
    {
        $this->_genre = $genre;
        return $this;
    }

    /**
     * @return string
     */
    public function getDirector(): string
    {
        return $this->_director;
    }

    /**
     * @param string $director
     * @return Movie
     */
    public function setDirector(string $director): Movie
    {
        $this->_director = $director;
        return $this;
    }


}
