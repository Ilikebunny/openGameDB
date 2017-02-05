<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompanyRepository")
 * @ExclusionPolicy("all")
 */
class Company {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"getGame"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Expose
     * @Groups({"getGame"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Platform", mappedBy="developers")
     */
    private $platform_developed;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Platform", mappedBy="manufacturers")
     */
    private $platform_manufactured;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Game", mappedBy="developers")
     */
    private $game_developed;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Game", mappedBy="publishers")
     */
    private $game_published;

    /**
     * To string
     */
    public function __toString() {
        return $this->name;
    }

    /**
     * Set id
     *
     * @param int $id
     *
     * @return Company
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
     * Set name
     *
     * @param string $name
     *
     * @return Company
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Company
     */
    public function setLogo($logo) {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo() {
        return $this->logo;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->platform_developed = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add platformDeveloped
     *
     * @param \AppBundle\Entity\Platform $platformDeveloped
     *
     * @return Company
     */
    public function addPlatformDeveloped(\AppBundle\Entity\Platform $platformDeveloped) {
        $this->platform_developed[] = $platformDeveloped;

        return $this;
    }

    /**
     * Remove platformDeveloped
     *
     * @param \AppBundle\Entity\Platform $platformDeveloped
     */
    public function removePlatformDeveloped(\AppBundle\Entity\Platform $platformDeveloped) {
        $this->platform_developed->removeElement($platformDeveloped);
    }

    /**
     * Get platformDeveloped
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlatformDeveloped() {
        return $this->platform_developed;
    }

    /**
     * Add platformManufactured
     *
     * @param \AppBundle\Entity\Platform $platformManufactured
     *
     * @return Company
     */
    public function addPlatformManufactured(\AppBundle\Entity\Platform $platformManufactured) {
        $this->platform_manufactured[] = $platformManufactured;

        return $this;
    }

    /**
     * Remove platformManufactured
     *
     * @param \AppBundle\Entity\Platform $platformManufactured
     */
    public function removePlatformManufactured(\AppBundle\Entity\Platform $platformManufactured) {
        $this->platform_manufactured->removeElement($platformManufactured);
    }

    /**
     * Get platformManufactured
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlatformManufactured() {
        return $this->platform_manufactured;
    }

    /**
     * Add gameDeveloped
     *
     * @param \AppBundle\Entity\Game $gameDeveloped
     *
     * @return Company
     */
    public function addGameDeveloped(\AppBundle\Entity\Game $gameDeveloped) {
        $this->game_developed[] = $gameDeveloped;

        return $this;
    }

    /**
     * Remove gameDeveloped
     *
     * @param \AppBundle\Entity\Game $gameDeveloped
     */
    public function removeGameDeveloped(\AppBundle\Entity\Game $gameDeveloped) {
        $this->game_developed->removeElement($gameDeveloped);
    }

    /**
     * Get gameDeveloped
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGameDeveloped() {
        return $this->game_developed;
    }

    /**
     * Add gamePublished
     *
     * @param \AppBundle\Entity\Game $gamePublished
     *
     * @return Company
     */
    public function addGamePublished(\AppBundle\Entity\Game $gamePublished) {
        $this->game_published[] = $gamePublished;

        return $this;
    }

    /**
     * Remove gamePublished
     *
     * @param \AppBundle\Entity\Game $gamePublished
     */
    public function removeGamePublished(\AppBundle\Entity\Game $gamePublished) {
        $this->game_published->removeElement($gamePublished);
    }

    /**
     * Get gamePublished
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGamePublished() {
        return $this->game_published;
    }

}
