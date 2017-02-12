<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlatformType
 *
 * @ORM\Table(name="platform_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlatformTypeRepository")
 */
class PlatformType {

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
     * @ORM\OneToMany(targetEntity="Platform", mappedBy="type")
     */
    protected $platforms;

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
     * @return PlatformType
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
     * Constructor
     */
    public function __construct() {
        $this->platforms = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add platform
     *
     * @param \AppBundle\Entity\Platform $platform
     *
     * @return PlatformType
     */
    public function addPlatform(\AppBundle\Entity\Platform $platform) {
        $this->platforms[] = $platform;

        return $this;
    }

    /**
     * Remove platform
     *
     * @param \AppBundle\Entity\Platform $platform
     */
    public function removePlatform(\AppBundle\Entity\Platform $platform) {
        $this->platforms->removeElement($platform);
    }

    /**
     * Get platforms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlatforms() {
        return $this->platforms;
    }

}
