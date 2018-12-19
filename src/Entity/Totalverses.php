<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Totalverses
 *
 * @ORM\Table(name="totalVerses")
 * @ORM\Entity
 */
class Totalverses
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
     * @ORM\Column(name="totalVerses", type="integer", nullable=true)
     */
    private $totalverses;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTotalverses(): ?int
    {
        return $this->totalverses;
    }

    public function setTotalverses(?int $totalverses): self
    {
        $this->totalverses = $totalverses;

        return $this;
    }


}
