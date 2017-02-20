<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlatformRelease
 *
 * @ORM\Table(name="platform_release")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlatformReleaseRepository")
 */
class PlatformRelease {

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="releaseDate", type="date", nullable=true)
     */
    private $releaseDate;

    /**
     * @var int
     *
     * @ORM\Column(name="unitSold", type="bigint", nullable=true)
     */
    private $unitSold;

    /**
     * @var \RegionCountry
     *
     * @ORM\ManyToOne(targetEntity="RegionCountry")
     */
    private $regionCountry;

    /**
     * @var \Platform
     *
     * @ORM\ManyToOne(targetEntity="Platform", inversedBy="releases")
     */
    private $platform;

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
     * @return PlatformRelease
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
     * Set releaseDate
     *
     * @param \DateTime $releaseDate
     *
     * @return PlatformRelease
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
     * Set unitSold
     *
     * @param integer $unitSold
     *
     * @return PlatformRelease
     */
    public function setUnitSold($unitSold) {
        $this->unitSold = $unitSold;

        return $this;
    }

    /**
     * Get unitSold
     *
     * @return int
     */
    public function getUnitSold() {
        return $this->unitSold;
    }

    /**
     * Set regionCountry
     *
     * @param \AppBundle\Entity\RegionCountry $regionCountry
     *
     * @return PlatformRelease
     */
    public function setRegionCountry(\AppBundle\Entity\RegionCountry $regionCountry = null) {
        $this->regionCountry = $regionCountry;

        return $this;
    }

    /**
     * Get regionCountry
     *
     * @return \AppBundle\Entity\RegionCountry
     */
    public function getRegionCountry() {
        return $this->regionCountry;
    }


    /**
     * Set platform
     *
     * @param \AppBundle\Entity\Platform $platform
     *
     * @return PlatformRelease
     */
    public function setPlatform(\AppBundle\Entity\Platform $platform = null)
    {
        $this->platform = $platform;

        return $this;
    }

    /**
     * Get platform
     *
     * @return \AppBundle\Entity\Platform
     */
    public function getPlatform()
    {
        return $this->platform;
    }
}
