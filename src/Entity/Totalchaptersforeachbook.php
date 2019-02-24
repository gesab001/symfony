<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Totalchaptersforeachbook
 *
 * @ORM\Table(name="totalChaptersForEachBook")
 * @ORM\Entity
 */
class Totalchaptersforeachbook
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
     * @ORM\Column(name="totalChapters", type="integer", nullable=true)
     */
    private $totalchapters;

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

    public function getTotalchapters(): ?int
    {
        return $this->totalchapters;
    }

    public function setTotalchapters(?int $totalchapters): self
    {
        $this->totalchapters = $totalchapters;

        return $this;
    }


}
