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


}
