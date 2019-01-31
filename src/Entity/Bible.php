<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BibleRepository")
 */
class Bible
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $book;

    /**
     * @ORM\Column(type="integer")
     */
    private $chapter;

    /**
     * @ORM\Column(type="integer")
     */
    private $verse;

    /**
     * @ORM\Column(type="text")
     */
    private $word;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBook(): ?string
    {
        return $this->book;
    }

    public function setBook(string $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getChapter(): ?int
    {
        return $this->chapter;
    }

    public function setChapter(int $chapter): self
    {
        $this->chapter = $chapter;

        return $this;
    }

    public function getVerse(): ?int
    {
        return $this->verse;
    }

    public function setVerse(int $verse): self
    {
        $this->verse = $verse;

        return $this;
    }

    public function getWord(): ?string
    {
        return $this->word;
    }

    public function setWord(string $word): self
    {
        $this->word = $word;

        return $this;
    }
}
