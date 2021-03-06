<?php

namespace CT\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;



/**
 * Movie
 *
 * @ORM\Table(name="movie")
 * @ORM\Entity(repositoryClass="CT\CoreBundle\Repository\MovieRepository")
 */
class Movie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     *
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="originalLanguage", type="string", length=255)
     */
    private $originalLanguage;

    /**
     * @var string
     *
     * @ORM\Column(name="originalTitle", type="string", length=255)
     */
    private $originalTitle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="releaseDate", type="datetime")
     */
    private $releaseDate;

    /**
     * @var array
     *
     * @ORM\Column(name="genres", type="array")
     */
    private $genres;

    /**
     * @var string
     *
     * @ORM\Column(name="overview", type="text", nullable=true)
     */
    private $overview;

    /**
     * @var string
     *
     * @ORM\Column(name="posterPath", type="string", length=255, nullable=true)
     */
    private $posterPath;

    /**
     * @var string
     *
     * @ORM\Column(name="backdropPath", type="string", length=255, nullable=true)
     */
    private $backdropPath;

    /**
     * @var float
     *
     * @ORM\Column(name="voteAverage", type="float", nullable=true)
     */
    private $voteAverage;

    /**
     * @var int
     *
     * @ORM\Column(name="voteCount", type="integer", nullable=true)
     */
    private $voteCount;

    /**
     * @var integer
     *
     * @ORM\Column(name="runTime", type="integer", nullable=true)
     */
    private $runTime;

    /**
     * @var array
     *
     * @ORM\Column(name="author", type="array")
     */
    private $author;

    /**
     * @var array
     *
     * @ORM\Column(name="cast", type="array")
     */
    private $cast;

    /**
     * @var float
     *
     * @ORM\Column(name="violence", type="float", nullable=true)
     */
    private $violence;

    /**
     * @var float
     *
     * @ORM\Column(name="complexity", type="float", nullable=true)
     */
    private $complexity;

    /**
     * @var float
     *
     * @ORM\Column(name="twist", type="float", nullable=true)
     */
    private $twist;

    /**
     * @var float
     *
     * @ORM\Column(name="emotion", type="float", nullable=true)
     */
    private $emotion;

    /**
     * @var float
     *
     * @ORM\Column(name="specialEffects", type="float", nullable=true)
     */
    private $specialEffects;

    /**
     * @var float
     *
     * @ORM\Column(name="originality", type="float", nullable=true)
     */
    private $originality;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer", nullable=true)
     */
    private $age;

    /**
     * @var float
     *
     * @ORM\Column(name="voteAverageCT", type="float", nullable=true)
     */
    private $voteAverageCT;

    /**
     * @ORM\Column(name="published", type="boolean")
     */
    private $published = true;

    /**
     * @var int
     *
     * @ORM\Column(name="voteCountCT", type="integer", nullable=true)
     */
    private $voteCountCT;


    /**
     * @ORM\ManyToMany(targetEntity="CT\UserBundle\Entity\User", inversedBy="movies")
     */
    protected $users;

    /**
     * @ORM\ManyToMany(targetEntity="CT\UserBundle\Entity\User", inversedBy="movieList")
     * @ORM\JoinTable(name="movie_bookseller")
     */
    protected $booksellers;


    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text", nullable=true)
     */

    protected $comments;



    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->booksellers = new ArrayCollection();

        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        //$this->genres = new genres();
        // $this->author = new crew();
        //$this->cast = new cast();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get id
     *
     * @param integer $id
     *
     * @return Movie
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Movie
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set originalLanguage
     *
     * @param string $originalLanguage
     *
     * @return Movie
     */
    public function setOriginalLanguage($originalLanguage)
    {
        $this->originalLanguage = $originalLanguage;

        return $this;
    }

    /**
     * Get originalLanguage
     *
     * @return string
     */
    public function getOriginalLanguage()
    {
        return $this->originalLanguage;
    }

    /**
     * Set releaseDate
     *
     * @param \DateTime $releaseDate
     *
     * @return Movie
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate
     *
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set genres
     *
     * @param array $genres
     *
     * @return Movie
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;

        return $this;
    }

    /**
     * Get genres
     *
     * @return array
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * Set overview
     *
     * @param string $overview
     *
     * @return Movie
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;

        return $this;
    }

    /**
     * Get overview
     *
     * @return string
     */
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * Set posterPath
     *
     * @param string $posterPath
     *
     * @return Movie
     */
    public function setPosterPath($posterPath)
    {
        $this->posterPath = $posterPath;

        return $this;
    }

    /**
     * Get posterPath
     *
     * @return string
     */
    public function getPosterPath()
    {
        return $this->posterPath;
    }

    /**
     * Set backdropPath
     *
     * @param string $backdropPath
     *
     * @return Movie
     */
    public function setBackdropPath($backdropPath)
    {
        $this->backdropPath = $backdropPath;

        return $this;
    }

    /**
     * Get backdropPath
     *
     * @return string
     */
    public function getBackdropPath()
    {
        return $this->backdropPath;
    }

    /**
     * Set voteAverage
     *
     * @param float $voteAverage
     *
     * @return Movie
     */
    public function setVoteAverage($voteAverage)
    {
        $this->voteAverage = $voteAverage;

        return $this;
    }

    /**
     * Get voteAverage
     *
     * @return float
     */
    public function getVoteAverage()
    {
        return $this->voteAverage;
    }

    /**
     * Set voteCount
     *
     * @param integer $voteCount
     *
     * @return Movie
     */
    public function setVoteCount($voteCount)
    {
        $this->voteCount = $voteCount;

        return $this;
    }

    /**
     * Get voteCount
     *
     * @return int
     */
    public function getVoteCount()
    {
        return $this->voteCount;
    }

    /**
     * Set author
     *
     * @param array $author
     *
     * @return Movie
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return array
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set cast
     *
     * @param array $cast
     *
     * @return Movie
     */
    public function setCast($cast)
    {
        $this->cast = $cast;

        return $this;
    }

    /**
     * Get cast
     *
     * @return array
     */
    public function getCast()
    {
        return $this->cast;
    }

    /**
     * Set violence
     *
     * @param float $violence
     *
     * @return Movie
     */
    public function setViolence($violence)
    {
        if($this->getVoteCountCT() == 0)
        {
            $this->violence = $violence;
        }
        else
        {
            $this->violence = ($this->getViolence()*($this->getVoteCountCT()-1) + $violence)/($this->getVoteCountCT());
        }

        return $this;
    }

    /**
     * Get violence
     *
     * @return float
     */
    public function getViolence()
    {
        return $this->violence;
    }

    /**
     * Set complexity
     *
     * @param float $complexity
     *
     * @return Movie
     */
    public function setComplexity($complexity)
    {
        if($this->getVoteCountCT() == 0)
        {
            $this->complexity = $complexity;
        }
        else
        {
            $this->complexity = ($this->getComplexity()*($this->getVoteCountCT()-1) + $complexity)/($this->getVoteCountCT());
        }

        return $this;
    }

    /**
     * Get complexity
     *
     * @return float
     */
    public function getComplexity()
    {
        return $this->complexity;
    }

    /**
     * Set twist
     *
     * @param float $twist
     *
     * @return Movie
     */
    public function setTwist($twist)
    {
        if($this->getVoteCountCT() == 0)
        {
            $this->twist = $twist;
        }
        else
        {
            $this->twist = ($this->getTwist()*($this->getVoteCountCT()-1) + $twist)/($this->getVoteCountCT());
        }

        return $this;
    }

    /**
     * Get twist
     *
     * @return float
     */
    public function getTwist()
    {
        return $this->twist;
    }

    /**
     * Set emotion
     *
     * @param float $emotion
     *
     * @return Movie
     */
    public function setEmotion($emotion)
    {
        if($this->getVoteCountCT() == 0)
        {
            $this->emotion = $emotion;
        }
        else
        {
            $this->emotion = (($this->getEmotion())*($this->getVoteCountCT()-1) + $emotion)/($this->getVoteCountCT());
        }

        return $this;
    }

    /**
     * Get emotion
     *
     * @return float
     */
    public function getEmotion()
    {
        return $this->emotion;
    }

    /**
     * Set specialEffects
     *
     * @param float $specialEffects
     *
     * @return Movie
     */
    public function setSpecialEffects($specialEffects)
    {
        if($this->getVoteCountCT() == 0)
        {
            $this->specialEffects = $specialEffects;
        }
        else
        {
            $this->specialEffects = ($this->getSpecialEffects()*($this->getVoteCountCT()-1) + $specialEffects)/($this->getVoteCountCT());
        }

        return $this;
    }

    /**
     * Get specialEffects
     *
     * @return float
     */
    public function getSpecialEffects()
    {
        return $this->specialEffects;
    }

    /**
     * Set originilaty
     *
     * @param float $originality
     *
     * @return Movie
     */
    public function setOriginality($originality)
    {
        if($this->getVoteCountCT() == 0)
        {
            $this->originality = $originality;
        }
        else
        {
            $this->originality = ($this->getOriginality()*($this->getVoteCountCT()-1) + $originality)/($this->getVoteCountCT());
        }

        return $this;
    }

    /**
     * Get originilaty
     *
     * @return float
     */
    public function getOriginality()
    {
        return $this->originality;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Movie
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set runTime
     *
     * @param integer $runTime
     *
     * @return Movie
     */
    public function setRunTime($runTime)
    {
        $this->runTime = $runTime;

        return $this;
    }

    /**
     * Get runTime
     *
     * @return integer
     */
    public function getRunTime()
    {
        return $this->runTime;
    }

    /**
     * Set originalTitle
     *
     * @param string $originalTitle
     *
     * @return Movie
     */
    public function setOriginalTitle($originalTitle)
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    /**
     * Get originalTitle
     *
     * @return string
     */
    public function getOriginalTitle()
    {
        return $this->originalTitle;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Movie
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set voteAverageCT
     *
     * @param float $voteAverageCT
     *
     * @return Movie
     */
    public function setVoteAverageCT($voteAverageCT)
    {

        if($this->getVoteCountCT() == 0)
        {
            $this->voteAverageCT = $voteAverageCT;
        }
        else
        {
            $this->voteAverageCT = (($this->getVoteAverageCT())*($this->getVoteCountCT()-1) + $voteAverageCT)/($this->getVoteCountCT());
        }

        return $this;
    }

    /**
     * Get voteAverageCT
     *
     * @return float
     */
    public function getVoteAverageCT()
    {
        return $this->voteAverageCT;
    }

    /**
     * Set voteCountCT
     *
     * @return Movie
     */
    public function setVoteCountCT()
    {
        $this->voteCountCT = $this->getVoteCountCT() + 1;

        return $this;
    }

    /**
     * Get voteCountCT
     *
     * @return integer
     */
    public function getVoteCountCT()
    {
        return $this->voteCountCT;
    }




    /**
     * Add user
     *
     * @param \CT\UserBundle\Entity\User $user
     *
     * @return Movie
     */
    public function addUser(\CT\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        $user->addMovie($this);

        return $this;
    }

    /**
     * Remove user
     *
     * @param \CT\UserBundle\Entity\User $user
     */
    public function removeUser(\CT\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add bookseller
     *
     * @param \CT\UserBundle\Entity\User $bookseller
     *
     * @return Movie
     */
    public function addBookseller(\CT\UserBundle\Entity\User $bookseller)
    {
        $this->booksellers[] = $bookseller;


        return $this;
    }

    /**
     * Remove bookseller
     *
     * @param \CT\UserBundle\Entity\User $bookseller
     */
    public function removeBookseller(\CT\UserBundle\Entity\User $bookseller)
    {
        $this->booksellers->removeElement($bookseller);
    }

    /**
     * Get booksellers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooksellers()
    {
        return $this->booksellers;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return Movie
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }
}
