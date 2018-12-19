<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Philemon
 *
 * @ORM\Table(name="Philemon")
 * @ORM\Entity
 */
class Philemon
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
     * @var int|null
     *
     * @ORM\Column(name="bookID", type="integer", nullable=true)
     */
    private $bookid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="book", type="text", length=65535, nullable=true)
     */
    private $book;

    /**
     * @var int|null
     *
     * @ORM\Column(name="chapter", type="integer", nullable=true)
     */
    private $chapter;

    /**
     * @var int|null
     *
     * @ORM\Column(name="verse", type="integer", nullable=true)
     */
    private $verse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="word", type="text", length=65535, nullable=true)
     */
    private $word;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="text", length=65535, nullable=true)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookid(): ?int
    {
        return $this->bookid;
    }

    public function setBookid(?int $bookid): self
    {
        $this->bookid = $bookid;

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

    public function getVerse(): ?int
    {
        return $this->verse;
    }

    public function setVerse(?int $verse): self
    {
        $this->verse = $verse;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }


}
