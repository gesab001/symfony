<?php

namespace App\Entity\Egw;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gc
 *
 * @ORM\Table(name="GC")
 * @ORM\Entity
 */
class Gc
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
     * @ORM\Column(name="URLIMAGE", type="string", length=255, nullable=true)
     */
    private $urlimage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="URLIMAGETITLE", type="string", length=255, nullable=true)
     */
    private $urlimagetitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="URLIMAGEDESCRIPTION", type="string", length=255, nullable=true)
     */
    private $urlimagedescription;


}
