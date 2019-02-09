<?php

namespace App\Entity\Egw;

use Doctrine\ORM\Mapping as ORM;

/**
 * EgwWritings
 *
 * @ORM\Table(name="egw_writings")
 * @ORM\Entity
 */
class EgwWritings
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="bookCode", type="text", length=65535, nullable=true)
     */
    private $bookcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="text", length=65535, nullable=true)
     */
    private $title;

    /**
     * @var int|null
     *
     * @ORM\Column(name="page", type="integer", nullable=true)
     */
    private $page;

    /**
     * @var int|null
     *
     * @ORM\Column(name="paragraph", type="integer", nullable=true)
     */
    private $paragraph;

    /**
     * @var string|null
     *
     * @ORM\Column(name="word", type="string", length=65000, nullable=true)
     */
    private $word;

    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    public function getBookcode(): ?string
    {
        return $this->bookcode;
    }

    public function setBookcode(?string $bookcode): self
    {
        $this->bookcode = $bookcode;

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

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(?int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getParagraph(): ?int
    {
        return $this->paragraph;
    }

    public function setParagraph(?int $paragraph): self
    {
        $this->paragraph = $paragraph;

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

    public function getId(): ?int
    {
        return $this->id;
    }


}
