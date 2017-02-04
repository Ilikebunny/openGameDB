<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContentRating
 *
 * @ORM\Table(name="content_rating")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContentRatingRepository")
 */
class ContentRating {

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
     * @ORM\Column(name="rating", type="string", length=255)
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var \ContentRatingOrganization
     *
     * @ORM\ManyToOne(targetEntity="ContentRatingOrganization", inversedBy="contentRatings")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contentRating_id", referencedColumnName="id")
     * })
     */
    private $contentRatingOrganization;

    /**
     * To string
     */
    public function __toString() {
        return $this->rating;
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
     * Set rating
     *
     * @param string $rating
     *
     * @return ContentRating
     */
    public function setRating($rating) {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return string
     */
    public function getRating() {
        return $this->rating;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return ContentRating
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set contentRatingOrganization
     *
     * @param \AppBundle\Entity\ContentRatingOrganization $contentRatingOrganization
     *
     * @return ContentRating
     */
    public function setContentRatingOrganization(\AppBundle\Entity\ContentRatingOrganization $contentRatingOrganization = null) {
        $this->contentRatingOrganization = $contentRatingOrganization;

        return $this;
    }

    /**
     * Get contentRatingOrganization
     *
     * @return \AppBundle\Entity\ContentRatingOrganization
     */
    public function getContentRatingOrganization() {
        return $this->contentRatingOrganization;
    }

}
