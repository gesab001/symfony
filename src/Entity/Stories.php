<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stories
 *
 * @ORM\Table(name="STORIES")
 * @ORM\Entity
 */
class Stories
{
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
     * @ORM\Column(name="TITLE", type="text", length=65535, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="BOOK", type="text", length=65535, nullable=true)
     */
    private $book;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CHAPTER", type="integer", nullable=true)
     */
    private $chapter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SUMMARY", type="text", length=65535, nullable=true)
     */
    private $summary;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBook(): ?string
    {
        return $this->book;
    }

    public function setBook(?string $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getChapter(): ?int
    {
        return $this->chapter;
    }

    public function setChapter(?int $chapter): self
    {
        $this->chapter = $chapter;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }


}
