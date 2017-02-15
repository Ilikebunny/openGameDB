<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Language
 *
 * @ORM\Table(name="language")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LanguageRepository")
 */
class Language
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
     * @ORM\Column(name="code_iso639_1", type="string", length=2, unique=true)
     */
    private $codeIso6391;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="nativeName", type="string", length=255)
     */
    private $nativeName;


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
     * Set codeIso6391
     *
     * @param string $codeIso6391
     *
     * @return Language
     */
    public function setCodeIso6391($codeIso6391)
    {
        $this->codeIso6391 = $codeIso6391;

        return $this;
    }

    /**
     * Get codeIso6391
     *
     * @return string
     */
    public function getCodeIso6391()
    {
        return $this->codeIso6391;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Language
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
     * Set nativeName
     *
     * @param string $nativeName
     *
     * @return Language
     */
    public function setNativeName($nativeName)
    {
        $this->nativeName = $nativeName;

        return $this;
    }

    /**
     * Get nativeName
     *
     * @return string
     */
    public function getNativeName()
    {
        return $this->nativeName;
    }
}

