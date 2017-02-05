<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * AlternateTitle
 *
 * @ORM\Table(name="alternate_title")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AlternateTitleRepository")
 * @ExclusionPolicy("all")
 */
class AlternateTitle {

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
     * @ORM\Column(name="title", type="string", length=255, unique=false)
     * @Expose
     * @Groups({"getGame", "GetPlatformGames"})
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="alternateTitles")
     * @ORM\JoinColumn(nullable=true)
     */
    private $game;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return AlternateTitle
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set game
     *
     * @param \AppBundle\Entity\Game $game
     *
     * @return AlternateTitle
     */
    public function setGame(\AppBundle\Entity\Game $game = null) {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \AppBundle\Entity\Game
     */
    public function getGame() {
        return $this->game;
    }

}
