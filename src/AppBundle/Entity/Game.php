<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 * @ExclusionPolicy("all")
 */
class Game {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"getGame", "GetPlatformGames", "getGameByPlatform"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Expose
     * @Groups({"getGame", "GetPlatformGames", "getGameByPlatform"})
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="releaseDate", type="date", nullable=true)
     * @Expose
     * @Groups({"getGame", "GetPlatformGames", "getGameByPlatform"})
     */
    private $releaseDate;

    /**
     * @var string
     *
     * @ORM\Column(name="overview", type="string", length=65535, nullable=true)
     * @Expose
     * @Groups({"getGame"})
     */
    private $overview;

    /**
     * @var string
     *
     * @ORM\Column(name="esrb", type="string", length=255, nullable=true)
     */
    private $esrb;

    /**
     * @var int
     *
     * @ORM\Column(name="players", type="integer", nullable=true)
     * @Expose
     * @Groups({"getGame"})
     */
    private $players;

    /**
     * @var bool
     *
     * @ORM\Column(name="coop", type="boolean", nullable=true)
     * @Expose
     * @Groups({"getGame"})
     */
    private $coop;

    /**
     * @var \Platform
     *
     * @ORM\ManyToOne(targetEntity="Platform", inversedBy="games")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="platform_id", referencedColumnName="id")
     * })
     * @Expose
     * @Groups({"getGame"})
     */
    private $platform;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Company", inversedBy="game_developed")
     * @ORM\JoinTable(name="game_developers",
     *   joinColumns={
     *     @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *   }
     * )
     * @Expose
     * @Groups({"getGame"})
     */
    private $developers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Company", inversedBy="game_published")
     * @ORM\JoinTable(name="game_publisher",
     *   joinColumns={
     *     @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *   }
     * )
     * @Expose
     * @Groups({"getGame"})
     */
    private $publishers;

    /**
     * @ORM\OneToMany(targetEntity="Art", mappedBy="game")
     * @Expose
     * @Groups({"getGame"})
     */
    private $arts;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="games")
     * @ORM\JoinTable(name="game_genre",
     *   joinColumns={
     *     @ORM\JoinColumn(name="game_id", referencedColumnName="id")
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
     * @ORM\OneToMany(targetEntity="AlternateTitle", mappedBy="game")
     * @Expose
     * @MaxDepth(2)
     * @Groups({"getGame", "GetPlatformGames"})
     */
    private $alternateTitles;

    /**
     * @ORM\OneToMany(targetEntity="GameLink", mappedBy="game_parent")
     */
    private $gameLinks;

    /**
     * @ORM\OneToMany(targetEntity="GameLink", mappedBy="game_child")
     */
    private $gameLinks_child;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ContentRating")
     * @ORM\JoinTable(name="game_ContentRating",
     *   joinColumns={
     *     @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="contentRating_id", referencedColumnName="id")
     *   }
     * )
     * @Expose
     * @MaxDepth(3)
     * @Groups({"getGame"})
     */
    private $contentRatings;

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
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Game
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
     * Set releaseDate
     *
     * @param \DateTime $releaseDate
     *
     * @return Game
     */
    public function setReleaseDate($releaseDate) {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate
     *
     * @return \DateTime
     */
    public function getReleaseDate() {
        return $this->releaseDate;
    }

    /**
     * Set overview
     *
     * @param string $overview
     *
     * @return Game
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
     * Set esrb
     *
     * @param string $esrb
     *
     * @return Game
     */
    public function setEsrb($esrb) {
        $this->esrb = $esrb;

        return $this;
    }

    /**
     * Get esrb
     *
     * @return string
     */
    public function getEsrb() {
        return $this->esrb;
    }

    /**
     * Set players
     *
     * @param integer $players
     *
     * @return Game
     */
    public function setPlayers($players) {
        $this->players = $players;

        return $this;
    }

    /**
     * Get players
     *
     * @return int
     */
    public function getPlayers() {
        return $this->players;
    }

    /**
     * Set coop
     *
     * @param boolean $coop
     *
     * @return Game
     */
    public function setCoop($coop) {
        $this->coop = $coop;

        return $this;
    }

    /**
     * Get coop
     *
     * @return bool
     */
    public function getCoop() {
        return $this->coop;
    }

    /**
     * Set platform
     *
     * @param \AppBundle\Entity\Platform $platform
     *
     * @return Game
     */
    public function setPlatform(\AppBundle\Entity\Platform $platform = null) {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get platform
     *
     * @return \AppBundle\Entity\Platform
     */
    public function getPlatform() {
        return $this->platform;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->developers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->publishers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add developer
     *
     * @param \AppBundle\Entity\Company $developer
     *
     * @return Game
     */
    public function addDeveloper(\AppBundle\Entity\Company $developer) {
        $this->developers[] = $developer;

        return $this;
    }

    /**
     * Remove developer
     *
     * @param \AppBundle\Entity\Company $developer
     */
    public function removeDeveloper(\AppBundle\Entity\Company $developer) {
        $this->developers->removeElement($developer);
    }

    /**
     * Get developers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDevelopers() {
        return $this->developers;
    }

    /**
     * Add publisher
     *
     * @param \AppBundle\Entity\Company $publisher
     *
     * @return Game
     */
    public function addPublisher(\AppBundle\Entity\Company $publisher) {
        $this->publishers[] = $publisher;

        return $this;
    }

    /**
     * Remove publisher
     *
     * @param \AppBundle\Entity\Company $publisher
     */
    public function removePublisher(\AppBundle\Entity\Company $publisher) {
        $this->publishers->removeElement($publisher);
    }

    /**
     * Get publishers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPublishers() {
        return $this->publishers;
    }

    /**
     * Add art
     *
     * @param \AppBundle\Entity\Art $art
     *
     * @return Game
     */
    public function addArt(\AppBundle\Entity\Art $art) {
        $this->arts[] = $art;

        return $this;
    }

    /**
     * Remove art
     *
     * @param \AppBundle\Entity\Art $art
     */
    public function removeArt(\AppBundle\Entity\Art $art) {
        $this->arts->removeElement($art);
    }

    /**
     * Get arts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArts() {
        return $this->arts;
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
     * Add alternateTitle
     *
     * @param \AppBundle\Entity\AlternateTitle $alternateTitle
     *
     * @return Game
     */
    public function addAlternateTitle(\AppBundle\Entity\AlternateTitle $alternateTitle) {
        $this->alternateTitles[] = $alternateTitle;

        return $this;
    }

    /**
     * Remove alternateTitle
     *
     * @param \AppBundle\Entity\AlternateTitle $alternateTitle
     */
    public function removeAlternateTitle(\AppBundle\Entity\AlternateTitle $alternateTitle) {
        $this->alternateTitles->removeElement($alternateTitle);
    }

    /**
     * Get alternateTitles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlternateTitles() {
        return $this->alternateTitles;
    }

    /**
     * Add gameLink
     *
     * @param \AppBundle\Entity\GameLink $gameLink
     *
     * @return Game
     */
    public function addGameLink(\AppBundle\Entity\GameLink $gameLink) {
        $this->gameLinks[] = $gameLink;

        return $this;
    }

    /**
     * Remove gameLink
     *
     * @param \AppBundle\Entity\GameLink $gameLink
     */
    public function removeGameLink(\AppBundle\Entity\GameLink $gameLink) {
        $this->gameLinks->removeElement($gameLink);
    }

    /**
     * Get gameLinks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGameLinks() {
        return $this->gameLinks;
    }

    /**
     * Add gameLinksChild
     *
     * @param \AppBundle\Entity\GameLink $gameLinksChild
     *
     * @return Game
     */
    public function addGameLinksChild(\AppBundle\Entity\GameLink $gameLinksChild) {
        $this->gameLinks_child[] = $gameLinksChild;

        return $this;
    }

    /**
     * Remove gameLinksChild
     *
     * @param \AppBundle\Entity\GameLink $gameLinksChild
     */
    public function removeGameLinksChild(\AppBundle\Entity\GameLink $gameLinksChild) {
        $this->gameLinks_child->removeElement($gameLinksChild);
    }

    /**
     * Get gameLinksChild
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGameLinksChild() {
        return $this->gameLinks_child;
    }

    /**
     * Add contentRating
     *
     * @param \AppBundle\Entity\ContentRating $contentRating
     *
     * @return Game
     */
    public function addContentRating(\AppBundle\Entity\ContentRating $contentRating) {
        $this->contentRatings[] = $contentRating;

        return $this;
    }

    /**
     * Remove contentRating
     *
     * @param \AppBundle\Entity\ContentRating $contentRating
     */
    public function removeContentRating(\AppBundle\Entity\ContentRating $contentRating) {
        $this->contentRatings->removeElement($contentRating);
    }

    /**
     * Get contentRatings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContentRatings() {
        return $this->contentRatings;
    }

    /**
     * Get BoxartFront
     *
     * @return \AppBundle\Entity\Art $art
     */
    public function getBoxartFront() {
        $myArt = null;
        foreach ($this->arts as $art) {
            if ($art->getType() == "BOXART_front")
                $myArt = $art;
        }
        return $myArt;
    }

    /**
     * Get BoxartFront
     *
     * @return \AppBundle\Entity\Art $art
     */
    public function getBoxartBack() {
        $myArt = null;
        foreach ($this->arts as $art) {
            if ($art->getType() == "BOXART_back")
                $myArt = $art;
        }
        return $myArt;
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
     * Get Art
     *
     * @return \AppBundle\Entity\Art $art
     */
    public function getScreenshots() {
        $myArts = Array();
        foreach ($this->arts as $art) {
            if ($art->getType() == "SCREENSHOT")
                $myArts[] = $art;
        }
        return $myArts;
    }

}
