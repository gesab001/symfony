<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecentHymns2
 *
 * @ORM\Table(name="RECENT_HYMNS2", uniqueConstraints={@ORM\UniqueConstraint(name="TITLE", columns={"TITLE"}), @ORM\UniqueConstraint(name="NUMBER", columns={"NUMBER"})})
 * @ORM\Entity
 */
class RecentHymns2
{
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

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ADDED_DATE", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $addedDate = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     *
     * @ORM\Column(name="POPULARITY", type="integer", nullable=false)
     */
    private $popularity = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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

    public function getAddedDate(): ?\DateTimeInterface
    {
        return $this->addedDate;
    }

    public function setAddedDate(\DateTimeInterface $addedDate): self
    {
        $this->addedDate = $addedDate;

        return $this;
    }

    public function getPopularity(): ?int
    {
        return $this->popularity;
    }

    public function setPopularity(int $popularity): self
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


}
