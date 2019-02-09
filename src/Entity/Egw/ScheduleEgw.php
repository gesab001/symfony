<?php

namespace App\Entity\Egw;

use Doctrine\ORM\Mapping as ORM;

/**
 * ScheduleEgw
 *
 * @ORM\Table(name="SCHEDULE_EGW", indexes={@ORM\Index(name="BOOKCODE", columns={"BOOKCODE"})})
 * @ORM\Entity
 */
class ScheduleEgw
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="DATE", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var \Books
     *
     * @ORM\ManyToOne(targetEntity="Books")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="BOOKCODE", referencedColumnName="bookCode")
     * })
     */
    private $bookcode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getBookcode(): ?Books
    {
        return $this->bookcode;
    }

    public function setBookcode(?Books $bookcode): self
    {
        $this->bookcode = $bookcode;

        return $this;
    }


}
