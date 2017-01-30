<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GameLink
 *
 * @ORM\Table(name="game_link")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameLinkRepository")
 */
class GameLink {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="gameLinks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game_parent;

    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="gameLinks_child")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game_child;

    /**
     * @ORM\ManyToOne(targetEntity="GameLinkType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set gameParent
     *
     * @param \AppBundle\Entity\Game $gameParent
     *
     * @return GameLink
     */
    public function setGameParent(\AppBundle\Entity\Game $gameParent) {
        $this->game_parent = $gameParent;

        return $this;
    }

    /**
     * Get gameParent
     *
     * @return \AppBundle\Entity\Game
     */
    public function getGameParent() {
        return $this->game_parent;
    }

    /**
     * Set gameChild
     *
     * @param \AppBundle\Entity\Game $gameChild
     *
     * @return GameLink
     */
    public function setGameChild(\AppBundle\Entity\Game $gameChild) {
        $this->game_child = $gameChild;

        return $this;
    }

    /**
     * Get gameChild
     *
     * @return \AppBundle\Entity\Game
     */
    public function getGameChild() {
        return $this->game_child;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\GameLinkType $type
     *
     * @return GameLink
     */
    public function setType(\AppBundle\Entity\GameLinkType $type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\GameLinkType
     */
    public function getType() {
        return $this->type;
    }

}
