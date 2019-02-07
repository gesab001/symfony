<?php

namespace App\Entity\Egw;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bible
 *
 * @ORM\Table(name="bible")
 * @ORM\Entity
 */
class Bible
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
     * @var string
     *
     * @ORM\Column(name="book", type="string", length=255, nullable=false)
     */
    private $book;

    /**
     * @var int
     *
     * @ORM\Column(name="chapter", type="integer", nullable=false)
     */
    private $chapter;

    /**
     * @var int
     *
     * @ORM\Column(name="verse", type="integer", nullable=false)
     */
    private $verse;

    /**
     * @var string
     *
     * @ORM\Column(name="word", type="text", length=0, nullable=false)
     */
    private $word;


}
