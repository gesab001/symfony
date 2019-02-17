<?php

namespace App\Entity\Egw;

use Doctrine\ORM\Mapping as ORM;

/**
 * Books
 *
 * @ORM\Table(name="books", indexes={@ORM\Index(name="bookmark", columns={"bookmark"})})
 * @ORM\Entity
 */
class Books
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     */
    private $id;

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="creation_date", type="datetime", nullable=true)
     */
    private $creationDate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="totalparagraphs", type="integer", nullable=true)
     */
    private $totalparagraphs;

    /**
     * @var \Da
     *
     * @ORM\ManyToOne(targetEntity="Da")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bookmark", referencedColumnName="ID")
     * })
     */
    private $bookmark;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $display_status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(?\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getTotalparagraphs(): ?int
    {
        return $this->totalparagraphs;
    }

    public function setTotalparagraphs(?int $totalparagraphs): self
    {
        $this->totalparagraphs = $totalparagraphs;

        return $this;
    }

    public function getBookmark(): ?Da
    {
        return $this->bookmark;
    }

    public function setBookmark(?Da $bookmark): self
    {
        $this->bookmark = $bookmark;

        return $this;
    }

    public function getDisplayStatus(): ?string
    {
        return $this->display_status;
    }

    public function setDisplayStatus(string $display_status): self
    {
        $this->display_status = $display_status;

        return $this;
    }


}
