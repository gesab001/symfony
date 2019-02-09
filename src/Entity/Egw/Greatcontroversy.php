<?php

namespace App\Entity\Egw;

use Doctrine\ORM\Mapping as ORM;

/**
 * Greatcontroversy
 *
 * @ORM\Table(name="greatControversy")
 * @ORM\Entity
 */
class Greatcontroversy
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="word", type="text", length=65535, nullable=true)
     */
    private $word;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true, options={"default"="unread"})
     */
    private $status = 'unread';

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="text", length=65535, nullable=true)
     */
    private $title;

    /**
     * @var int|null
     *
     * @ORM\Column(name="page", type="integer", nullable=true)
     */
    private $page;

    /**
     * @var int|null
     *
     * @ORM\Column(name="paragraph", type="integer", nullable=true)
     */
    private $paragraph;

    /**
     * @var string|null
     *
     * @ORM\Column(name="urlimage", type="text", length=65535, nullable=true)
     */
    private $urlimage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="urlimagetitle", type="text", length=65535, nullable=true)
     */
    private $urlimagetitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="urlimagedescription", type="text", length=65535, nullable=true)
     */
    private $urlimagedescription;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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
