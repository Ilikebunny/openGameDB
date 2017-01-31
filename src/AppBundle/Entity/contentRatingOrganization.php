<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * contentRatingOrganization
 *
 * @ORM\Table(name="content_rating_organization")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\contentRatingOrganizationRepository")
 */
class ContentRatingOrganization {

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
     * @ORM\Column(name="weblink", type="string", length=255)
     */
    private $weblink;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=65535)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="ContentRating", mappedBy="contentRatingOrganization")
     */
    private $contentRatings;

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
     * @return contentRatingOrganization
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
     * Set weblink
     *
     * @param string $weblink
     *
     * @return contentRatingOrganization
     */
    public function setWeblink($weblink) {
        $this->weblink = $weblink;

        return $this;
    }

    /**
     * Get weblink
     *
     * @return string
     */
    public function getWeblink() {
        return $this->weblink;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return contentRatingOrganization
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->contentRatings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contentRating
     *
     * @param \AppBundle\Entity\ContentRating $contentRating
     *
     * @return contentRatingOrganization
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

}
