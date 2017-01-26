<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 */
class Game {

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
     * @var \DateTime
     *
     * @ORM\Column(name="releaseDate", type="date", nullable=true)
     */
    private $releaseDate;

    /**
     * @var string
     *
     * @ORM\Column(name="overview", type="string", length=65535, nullable=true)
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
     */
    private $players;

    /**
     * @var bool
     *
     * @ORM\Column(name="coop", type="boolean", nullable=true)
     */
    private $coop;

    /**
     * @var \Platform
     *
     * @ORM\ManyToOne(targetEntity="Platform", inversedBy="games")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="platform_id", referencedColumnName="id")
     * })
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
     */
    private $publishers;

    /**
     * @ORM\OneToMany(targetEntity="Art", mappedBy="game")
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
     */
    private $genres;

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
    public function addGenre(\AppBundle\Entity\Genre $genre)
    {
        $this->genres[] = $genre;

        return $this;
    }

    /**
     * Remove genre
     *
     * @param \AppBundle\Entity\Genre $genre
     */
    public function removeGenre(\AppBundle\Entity\Genre $genre)
    {
        $this->genres->removeElement($genre);
    }

    /**
     * Get genres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGenres()
    {
        return $this->genres;
    }
}
