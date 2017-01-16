<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompanyRepository")
 */
class Company {

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
    public function addPlatformManufactured(\AppBundle\Entity\Platform $platformManufactured)
    {
        $this->platform_manufactured[] = $platformManufactured;

        return $this;
    }

    /**
     * Remove platformManufactured
     *
     * @param \AppBundle\Entity\Platform $platformManufactured
     */
    public function removePlatformManufactured(\AppBundle\Entity\Platform $platformManufactured)
    {
        $this->platform_manufactured->removeElement($platformManufactured);
    }

    /**
     * Get platformManufactured
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlatformManufactured()
    {
        return $this->platform_manufactured;
    }
}
