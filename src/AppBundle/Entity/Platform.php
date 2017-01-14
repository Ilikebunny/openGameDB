<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Platform
 *
 * @ORM\Table(name="platform")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlatformRepository")
 */
class Platform
{
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="overview", type="string", length=255, nullable=true)
     */
    private $overview;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="developer", type="string", length=255, nullable=true)
     */
    private $developer;

    /**
     * @var string
     *
     * @ORM\Column(name="manufacturer", type="string", length=255)
     */
    private $manufacturer;

    /**
     * @var string
     *
     * @ORM\Column(name="cpu", type="string", length=255, nullable=true)
     */
    private $cpu;

    /**
     * @var string
     *
     * @ORM\Column(name="memory", type="string", length=255, nullable=true)
     */
    private $memory;

    /**
     * @var string
     *
     * @ORM\Column(name="graphics", type="string", length=255, nullable=true)
     */
    private $graphics;

    /**
     * @var string
     *
     * @ORM\Column(name="sound_info", type="string", length=255, nullable=true)
     */
    private $soundInfo;

    /**
     * @var string
     *
     * @ORM\Column(name="display", type="string", length=255, nullable=true)
     */
    private $display;

    /**
     * @var int
     *
     * @ORM\Column(name="maxcontrollers", type="integer", nullable=true)
     */
    private $maxcontrollers;


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
     * Set name
     *
     * @param string $name
     *
     * @return Platform
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set overview
     *
     * @param string $overview
     *
     * @return Platform
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
     * Set type
     *
     * @param string $type
     *
     * @return Platform
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Platform
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set developer
     *
     * @param string $developer
     *
     * @return Platform
     */
    public function setDeveloper($developer)
    {
        $this->developer = $developer;

        return $this;
    }

    /**
     * Get developer
     *
     * @return string
     */
    public function getDeveloper()
    {
        return $this->developer;
    }

    /**
     * Set manufacturer
     *
     * @param string $manufacturer
     *
     * @return Platform
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return string
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set cpu
     *
     * @param string $cpu
     *
     * @return Platform
     */
    public function setCpu($cpu)
    {
        $this->cpu = $cpu;

        return $this;
    }

    /**
     * Get cpu
     *
     * @return string
     */
    public function getCpu()
    {
        return $this->cpu;
    }

    /**
     * Set memory
     *
     * @param string $memory
     *
     * @return Platform
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;

        return $this;
    }

    /**
     * Get memory
     *
     * @return string
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * Set graphics
     *
     * @param string $graphics
     *
     * @return Platform
     */
    public function setGraphics($graphics)
    {
        $this->graphics = $graphics;

        return $this;
    }

    /**
     * Get graphics
     *
     * @return string
     */
    public function getGraphics()
    {
        return $this->graphics;
    }

    /**
     * Set soundInfo
     *
     * @param string $soundInfo
     *
     * @return Platform
     */
    public function setSoundInfo($soundInfo)
    {
        $this->soundInfo = $soundInfo;

        return $this;
    }

    /**
     * Get soundInfo
     *
     * @return string
     */
    public function getSoundInfo()
    {
        return $this->soundInfo;
    }

    /**
     * Set display
     *
     * @param string $display
     *
     * @return Platform
     */
    public function setDisplay($display)
    {
        $this->display = $display;

        return $this;
    }

    /**
     * Get display
     *
     * @return string
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * Set maxcontrollers
     *
     * @param integer $maxcontrollers
     *
     * @return Platform
     */
    public function setMaxcontrollers($maxcontrollers)
    {
        $this->maxcontrollers = $maxcontrollers;

        return $this;
    }

    /**
     * Get maxcontrollers
     *
     * @return int
     */
    public function getMaxcontrollers()
    {
        return $this->maxcontrollers;
    }
}

