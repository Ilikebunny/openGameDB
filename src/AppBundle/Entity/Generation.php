<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Generation
 *
 * @ORM\Table(name="generation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenerationRepository")
 */
class Generation {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer", unique=true)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="overview", type="string", length=65535, nullable=true)
     */
    private $overview;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="beginning", type="date", nullable=true)
     */
    private $beginning;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ending", type="date", nullable=true)
     */
    private $ending;

    /**
     * @ORM\OneToMany(targetEntity="Platform", mappedBy="generation")
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
     * Set number
     *
     * @param integer $number
     *
     * @return Generation
     */
    public function setNumber($number) {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * Set overview
     *
     * @param string $overview
     *
     * @return Generation
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
     * Set beginning
     *
     * @param \DateTime $beginning
     *
     * @return Generation
     */
    public function setBeginning($beginning) {
        $this->beginning = $beginning;

        return $this;
    }

    /**
     * Get beginning
     *
     * @return \DateTime
     */
    public function getBeginning() {
        return $this->beginning;
    }

    /**
     * Set ending
     *
     * @param \DateTime $ending
     *
     * @return Generation
     */
    public function setEnding($ending) {
        $this->ending = $ending;

        return $this;
    }

    /**
     * Get ending
     *
     * @return \DateTime
     */
    public function getEnding() {
        return $this->ending;
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
     * @return Generation
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Generation
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

}
