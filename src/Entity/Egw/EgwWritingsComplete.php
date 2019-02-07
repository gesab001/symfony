<?php

namespace App\Entity\Egw;

use Doctrine\ORM\Mapping as ORM;

/**
 * EgwWritingsComplete
 *
 * @ORM\Table(name="egw_writings_complete", indexes={@ORM\Index(name="BOOKCODE", columns={"BOOKCODE"})})
 * @ORM\Entity
 */
class EgwWritingsComplete
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


}
