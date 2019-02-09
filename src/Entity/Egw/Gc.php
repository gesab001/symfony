<?php

namespace App\Entity\Egw;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gc
 *
 * @ORM\Table(name="GC")
 * @ORM\Entity
 */
class Gc
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="BOOKCODE", type="string", length=255, nullable=true)
     */
    private $bookcode;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PAGE", type="integer", nullable=true)
     */
    private $page;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PARAGRAPH", type="integer", nullable=true)
     */
    private $paragraph;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORD", type="text", length=65535, nullable=true)
     */
    private $word;

    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="URLIMAGE", type="string", length=255, nullable=true)
     */
    private $urlimage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="URLIMAGETITLE", type="string", length=255, nullable=true)
     */
    private $urlimagetitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="URLIMAGEDESCRIPTION", type="string", length=255, nullable=true)
     */
    private $urlimagedescription;

    public function getBookcode(): ?string
    {
        return $this->bookcode;
    }

    public function setBookcode(?string $bookcode): self
    {
        $this->bookcode = $bookcode;

        return $this;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getParagraph(): ?int
    {
        return $this->paragraph;
    }

    public function setParagraph(?int $paragraph): self
    {
        $this->paragraph = $paragraph;

        return $this;
    }

    public function getWord(): ?string
    {
        return $this->word;
    }

    public function setWord(?string $word): self
    {
        $this->word = $word;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrlimage(): ?string
    {
        return $this->urlimage;
    }

    public function setUrlimage(?string $urlimage): self
    {
        $this->urlimage = $urlimage;

        return $this;
    }

    public function getUrlimagetitle(): ?string
    {
        return $this->urlimagetitle;
    }

    public function setUrlimagetitle(?string $urlimagetitle): self
    {
        $this->urlimagetitle = $urlimagetitle;

        return $this;
    }

    public function getUrlimagedescription(): ?string
    {
        return $this->urlimagedescription;
    }

    public function setUrlimagedescription(?string $urlimagedescription): self
    {
        $this->urlimagedescription = $urlimagedescription;

        return $this;
    }


}
