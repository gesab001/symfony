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


}
