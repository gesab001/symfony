<?php

namespace App\Entity\Egw;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bible
 *
 * @ORM\Table(name="bible")
 * @ORM\Entity
 */
class Bible
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
     * @var string
     *
     * @ORM\Column(name="book", type="string", length=255, nullable=false)
     */
    private $book;

    /**
     * @var int
     *
     * @ORM\Column(name="chapter", type="integer", nullable=false)
     */
    private $chapter;

    /**
     * @var int
     *
     * @ORM\Column(name="verse", type="integer", nullable=false)
     */
    private $verse;

    /**
     * @var string
     *
     * @ORM\Column(name="word", type="text", length=0, nullable=false)
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
