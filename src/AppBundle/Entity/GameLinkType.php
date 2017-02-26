<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * GameLinkType
 *
 * @ORM\Table(name="game_link_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameLinkTypeRepository")
 * @ExclusionPolicy("all")
 */
class GameLinkType {

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
     * @ORM\Column(name="linkType", type="string", length=255, unique=true)
     * @Expose
     * @Groups({"getGame"})
     */
    private $linkType;

    /**
     * To string
     */
    public function __toString() {
        return $this->linkType;
    }

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
     * Set linkType
     *
     * @param string $linkType
     *
     * @return GameLinkType
     */
    public function setLinkType($linkType) {
        $this->linkType = $linkType;

        return $this;
    }

    /**
     * Get linkType
     *
     * @return string
     */
    public function getLinkType() {
        return $this->linkType;
    }

}
