<?php

namespace App\Entity\Egw;

use Doctrine\ORM\Mapping as ORM;

/**
 * Egwimages
 *
 * @ORM\Table(name="EGWIMAGES")
 * @ORM\Entity
 */
class Egwimages
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="BOOKCODE", type="text", length=65535, nullable=true)
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
     * @ORM\Column(name="URLIMAGE", type="text", length=65535, nullable=true)
     */
    private $urlimage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="URLIMAGETITLE", type="text", length=65535, nullable=true)
     */
    private $urlimagetitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="URLIMAGEDESCRIPTION", type="text", length=65535, nullable=true)
     */
    private $urlimagedescription;

    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}
