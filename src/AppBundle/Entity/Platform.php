<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * Platform
 *
 * @ORM\Table(name="platform")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlatformRepository")
 * @ExclusionPolicy("all")
 */
class Platform {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * @Groups({"getGame", "getPlatform","getPlatformList"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Expose
     * @Groups({"getPlatform", "getPlatformList"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="overview", type="string", length=65535, nullable=true)
     * @Expose
     * @Groups({"getPlatform"})
     */
    private $overview;

    /**
     * @var \PlatformType
     *
     * @ORM\ManyToOne(targetEntity="PlatformType", inversedBy="platforms")
     * @Expose
     * @Groups({"getPlatform", "getPlatformList"})
     */
    private $type;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     * @Expose
     * @Groups({"getPlatform", "getPlatformList"})
     */
    private $slug;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Company", inversedBy="platform_developed")
     * @ORM\JoinTable(name="platform_developers",
     *   joinColumns={
     *     @ORM\JoinColumn(name="platform_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *   }
     * )
     * @Expose
     * @Groups({"getPlatform"})
     */
    private $developers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Company", inversedBy="platform_manufactured")
     * @ORM\JoinTable(name="platform_manufacturers",
     *   joinColumns={
     *     @ORM\JoinColumn(name="platform_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *   }
     * )
     * @Expose
     * @Groups({"getPlatform"})
     */
    private $manufacturers;

    /**
     * @var string
     *
     * @ORM\Column(name="cpu", type="string", length=255, nullable=true)
     * @Expose
     * @Groups({"getPlatform"})
     */
    private $cpu;

    /**
     * @var string
     *
     * @ORM\Column(name="memory", type="string", length=255, nullable=true)
     * @Expose
     * @Groups({"getPlatform"})
     */
    private $memory;

    /**
     * @var string
     *
     * @ORM\Column(name="graphics", type="string", length=255, nullable=true)
     * @Expose
     * @Groups({"getPlatform"})
     */
    private $graphics;

    /**
     * @var string
     *
     * @ORM\Column(name="sound_info", type="string", length=255, nullable=true)
     * @Expose
     * @Groups({"getPlatform"})
     */
    private $soundInfo;

    /**
     * @var string
     *
     * @ORM\Column(name="display", type="string", length=255, nullable=true)
     * @Expose
     * @Groups({"getPlatform"})
     */
    private $display;

    /**
     * @var int
     *
     * @ORM\Column(name="maxcontrollers", type="integer", nullable=true)
     * @Expose
     * @Groups({"getPlatform"})
     */
    private $maxcontrollers;

    /**
     * @ORM\OneToMany(targetEntity="Game", mappedBy="platform")
     */
    protected $games;

    /**
     * @ORM\OneToMany(targetEntity="Art", mappedBy="platform")
     * @Expose
     * @Groups({"getPlatform"})
     */
    private $arts;

    /**
     * @var \Generation
     *
     * @ORM\ManyToOne(targetEntity="Generation", inversedBy="platforms")
     */
    private $generation;

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
     * To string
     */
    public function __toString() {
        return $this->name;
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
     * @return Platform
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
     * Set overview
     *
     * @param string $overview
     *
     * @return Platform
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
     * Set type
     *
     * @param string $type
     *
     * @return Platform
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Platform
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set cpu
     *
     * @param string $cpu
     *
     * @return Platform
     */
    public function setCpu($cpu) {
        $this->cpu = $cpu;

        return $this;
    }

    /**
     * Get cpu
     *
     * @return string
     */
    public function getCpu() {
        return $this->cpu;
    }

    /**
     * Set memory
     *
     * @param string $memory
     *
     * @return Platform
     */
    public function setMemory($memory) {
        $this->memory = $memory;

        return $this;
    }

    /**
     * Get memory
     *
     * @return string
     */
    public function getMemory() {
        return $this->memory;
    }

    /**
     * Set graphics
     *
     * @param string $graphics
     *
     * @return Platform
     */
    public function setGraphics($graphics) {
        $this->graphics = $graphics;

        return $this;
    }

    /**
     * Get graphics
     *
     * @return string
     */
    public function getGraphics() {
        return $this->graphics;
    }

    /**
     * Set soundInfo
     *
     * @param string $soundInfo
     *
     * @return Platform
     */
    public function setSoundInfo($soundInfo) {
        $this->soundInfo = $soundInfo;

        return $this;
    }

    /**
     * Get soundInfo
     *
     * @return string
     */
    public function getSoundInfo() {
        return $this->soundInfo;
    }

    /**
     * Set display
     *
     * @param string $display
     *
     * @return Platform
     */
    public function setDisplay($display) {
        $this->display = $display;

        return $this;
    }

    /**
     * Get display
     *
     * @return string
     */
    public function getDisplay() {
        return $this->display;
    }

    /**
     * Set maxcontrollers
     *
     * @param integer $maxcontrollers
     *
     * @return Platform
     */
    public function setMaxcontrollers($maxcontrollers) {
        $this->maxcontrollers = $maxcontrollers;

        return $this;
    }

    /**
     * Get maxcontrollers
     *
     * @return int
     */
    public function getMaxcontrollers() {
        return $this->maxcontrollers;
    }

    /**
     * Set developer
     *
     * @param \AppBundle\Entity\Company $developer
     *
     * @return Platform
     */
    public function setDeveloper(\AppBundle\Entity\Company $developer = null) {
        $this->developer = $developer;

        return $this;
    }

    /**
     * Get developer
     *
     * @return \AppBundle\Entity\Company
     */
    public function getDeveloper() {
        return $this->developer;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->developers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add developer
     *
     * @param \AppBundle\Entity\Company $developer
     *
     * @return Platform
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
     * Add manufacturer
     *
     * @param \AppBundle\Entity\Company $manufacturer
     *
     * @return Platform
     */
    public function addManufacturer(\AppBundle\Entity\Company $manufacturer) {
        $this->manufacturers[] = $manufacturer;

        return $this;
    }

    /**
     * Remove manufacturer
     *
     * @param \AppBundle\Entity\Company $manufacturer
     */
    public function removeManufacturer(\AppBundle\Entity\Company $manufacturer) {
        $this->manufacturers->removeElement($manufacturer);
    }

    /**
     * Get manufacturers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getManufacturers() {
        return $this->manufacturers;
    }

    /**
     * Add game
     *
     * @param \AppBundle\Entity\Game $game
     *
     * @return Platform
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
     * Add art
     *
     * @param \AppBundle\Entity\Art $art
     *
     * @return Platform
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
     * Get BoxartBack
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
     * Set generation
     *
     * @param \AppBundle\Entity\Generation $generation
     *
     * @return Platform
     */
    public function setGeneration(\AppBundle\Entity\Generation $generation = null) {
        $this->generation = $generation;

        return $this;
    }

    /**
     * Get generation
     *
     * @return \AppBundle\Entity\Generation
     */
    public function getGeneration() {
        return $this->generation;
    }

}
