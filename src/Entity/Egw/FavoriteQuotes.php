<?php

namespace App\Entity\Egw;

use Doctrine\ORM\Mapping as ORM;

/**
 * FavoriteQuotes
 *
 * @ORM\Table(name="FAVORITE_QUOTES")
 * @ORM\Entity
 */
class FavoriteQuotes
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="BOOKCODE", type="string", length=255, nullable=true)
     */
    private $bookcode;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PAGE", type="integer", nullable=true)
     */
    private $page;

    /**
     * @var int|null
     *
     * @ORM\Column(name="PARAGRAPH", type="integer", nullable=true)
     */
    private $paragraph;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WORD", type="text", length=65535, nullable=true)
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

    /**
     * @var string|null
     *
     * @ORM\Column(name="USER", type="text", length=65535, nullable=true)
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ADDED_DATE", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $addedDate = 'CURRENT_TIMESTAMP';

    public function getBookcode(): ?string
    {
        return $this->bookcode;
    }

    public function setBookcode(?string $bookcode): self
    {
        $this->bookcode = $bookcode;

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

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(?string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAddedDate(): ?\DateTimeInterface
    {
        return $this->addedDate;
    }

    public function setAddedDate(\DateTimeInterface $addedDate): self
    {
        $this->addedDate = $addedDate;

        return $this;
    }


}
