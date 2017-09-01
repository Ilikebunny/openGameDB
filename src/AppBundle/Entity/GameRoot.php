<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * GameRoot
 *
 * @ORM\Table(name="game_root")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRootRepository")
 */
class GameRoot {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="overview", type="text", nullable=true)
     */
    private $overview;

    /**
     * @ORM\OneToMany(targetEntity="Game", mappedBy="gameRoot")
     */
    protected $games;

    /**
     * @ORM\OneToMany(targetEntity="Art", mappedBy="gameRoot")
     * @Expose
     * @Groups({"getGame"})
     */
    private $arts;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="gameroots")
     * @ORM\JoinTable(name="game_root_genre",
     *   joinColumns={
     *     @ORM\JoinColumn(name="game_root_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="genre_id", referencedColumnName="id")
     *   }
     * )
     * @Expose
     * @Groups({"getGame"})
     */
    private $genres;

    /**
     * To string
     */
    public function __toString() {
        return $this->title;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param int $id
     *
     * @return Platform
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return GameRoot
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set overview
     *
     * @param string $overview
     *
     * @return GameRoot
     */
    public function setOverview($overview) {
        $this->overview = $overview;

        return $this;
    }

    /**
     * Get overview
     *
     * @return string
     */
    public function getOverview() {
        return $this->overview;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add game
     *
     * @param \AppBundle\Entity\Game $game
     *
     * @return GameRoot
     */
    public function addGame(\AppBundle\Entity\Game $game) {
        $this->games[] = $game;

        return $this;
    }

    /**
     * Remove game
     *
     * @param \AppBundle\Entity\Game $game
     */
    public function removeGame(\AppBundle\Entity\Game $game) {
        $this->games->removeElement($game);
    }

    /**
     * Get games
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGames() {
        return $this->games;
    }

    /**
     * Add genre
     *
     * @param \AppBundle\Entity\Genre $genre
     *
     * @return Game
     */
    public function addGenre(\AppBundle\Entity\Genre $genre) {
        $this->genres[] = $genre;

        return $this;
    }

    /**
     * Remove genre
     *
     * @param \AppBundle\Entity\Genre $genre
     */
    public function removeGenre(\AppBundle\Entity\Genre $genre) {
        $this->genres->removeElement($genre);
    }

    /**
     * Get genres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGenres() {
        return $this->genres;
    }

    /**
     * Get games
     *
     * @return \AppBundle\Entity\Art $art
     */
    public function getGames_Version() {
        $myGames = Array();
        foreach ($this->games as $game) {
            if ($game->getType() == "") {
                $myGames[] = $game;
            }
        }
        return $myGames;
    }

    /**
     * Get games
     *
     * @return \AppBundle\Entity\Art $art
     */
    public function getGames_Edition() {
        $myGames = Array();
        foreach ($this->games as $game) {
            if ($game->getType() == "Special Edition") {
                $myGames[] = $game;
            }
        }
        return $myGames;
    }

    /**
     * Get arts
     *
     * @return Array
     */
    public function getFanarts() {
        $myArts = Array();
        foreach ($this->arts as $art) {
            if ($art->getType() == "FANART")
                $myArts[] = $art;
        }
        return $myArts;
    }

    /**
     * Get arts
     *
     * @return Array
     */
    public function getBanners() {
        $myArts = Array();
        foreach ($this->arts as $art) {
            if ($art->getType() == "BANNER")
                $myArts[] = $art;
        }
        return $myArts;
    }

    /**
     * Get Art
     *
     * @return \AppBundle\Entity\Art $art
     */
    public function getClearlogo() {
        $myArt = null;
        foreach ($this->arts as $art) {
            if ($art->getType() == "CLEARLOGO")
                $myArt = $art;
        }
        return $myArt;
    }


    /**
     * Add art
     *
     * @param \AppBundle\Entity\Art $art
     *
     * @return GameRoot
     */
    public function addArt(\AppBundle\Entity\Art $art)
    {
        $this->arts[] = $art;

        return $this;
    }

    /**
     * Remove art
     *
     * @param \AppBundle\Entity\Art $art
     */
    public function removeArt(\AppBundle\Entity\Art $art)
    {
        $this->arts->removeElement($art);
    }

    /**
     * Get arts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArts()
    {
        return $this->arts;
    }
}
