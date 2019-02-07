<?php

namespace App\Entity\Egw;

use Doctrine\ORM\Mapping as ORM;

/**
 * Greatcontroversy
 *
 * @ORM\Table(name="greatControversy")
 * @ORM\Entity
 */
class Greatcontroversy
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
     * @ORM\Column(name="word", type="text", length=65535, nullable=true)
     */
    private $word;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true, options={"default"="unread"})
     */
    private $status = 'unread';

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
     * @ORM\Column(name="urlimage", type="text", length=65535, nullable=true)
     */
    private $urlimage;

    /**
     * @var string|null
     *
     * @ORM\Column(name="urlimagetitle", type="text", length=65535, nullable=true)
     */
    private $urlimagetitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="urlimagedescription", type="text", length=65535, nullable=true)
     */
    private $urlimagedescription;


}
