<?php

namespace App\Entity\Egw;

use Doctrine\ORM\Mapping as ORM;

/**
 * Egwtitles
 *
 * @ORM\Table(name="egwTitles")
 * @ORM\Entity
 */
class Egwtitles
{
    /**
     * @var string
     *
     * @ORM\Column(name="bookCode", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bookcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bookTitle", type="string", length=255, nullable=true)
     */
    private $booktitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="year", type="string", length=255, nullable=true)
     */
    private $year;

    public function getBookcode(): ?string
    {
        return $this->bookcode;
    }

    public function getBooktitle(): ?string
    {
        return $this->booktitle;
    }

    public function setBooktitle(?string $booktitle): self
    {
        $this->booktitle = $booktitle;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): self
    {
        $this->year = $year;

        return $this;
    }


}
