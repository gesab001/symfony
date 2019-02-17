<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Books
 *
 * @ORM\Table(name="biblebooks")
 * @ORM\Entity
 */
class Books
{
    /**
     * @var int
     *
     * @ORM\Column(name="bookID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @ORM\Column(name="chapters", type="integer", nullable=true)
     */
    private $chapters;

    /**
     * @var int|null
     *
     * @ORM\Column(name="verses", type="integer", nullable=true)
     */
    private $verses;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="startDate", type="date", nullable=true)
     */
    private $startdate;

    public function getBookid(): ?int
    {
        return $this->bookid;
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

    public function getChapters(): ?int
    {
        return $this->chapters;
    }

    public function setChapters(?int $chapters): self
    {
        $this->chapters = $chapters;

        return $this;
    }

    public function getVerses(): ?int
    {
        return $this->verses;
    }

    public function setVerses(?int $verses): self
    {
        $this->verses = $verses;

        return $this;
    }

    public function getStartdate(): ?\DateTimeInterface
    {
        return $this->startdate;
    }

    public function setStartdate(?\DateTimeInterface $startdate): self
    {
        $this->startdate = $startdate;

        return $this;
    }


}
