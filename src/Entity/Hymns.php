<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hymns
 *
 * @ORM\Table(name="HYMNS")
 * @ORM\Entity
 */
class Hymns
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
     * @var int|null
     *
     * @ORM\Column(name="NUMBER", type="integer", nullable=true)
     */
    private $number;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TITLE", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="VERSES", type="text", length=65535, nullable=true)
     */
    private $verses;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

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

    public function getVerses(): ?string
    {
        return $this->verses;
    }

    public function setVerses(?string $verses): self
    {
        $this->verses = $verses;

        return $this;
    }


}
