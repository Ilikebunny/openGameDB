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

}
