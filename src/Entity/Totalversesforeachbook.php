<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Totalversesforeachbook
 *
 * @ORM\Table(name="totalVersesForEachBook")
 * @ORM\Entity
 */
class Totalversesforeachbook
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="book", type="text", length=65535, nullable=true)
     */
    private $book;

    /**
     * @var int|null
     *
     * @ORM\Column(name="totalVerses", type="integer", nullable=true)
     */
    private $totalverses;

    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    public function getBook(): ?string
    {
        return $this->book;
    }

    public function setBook(?string $book): self
    {
        $this->book = $book;

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

    public function getId(): ?int
    {
        return $this->id;
    }


}
