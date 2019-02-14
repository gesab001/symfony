<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use MyBundle\Entity\Document;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\VideosRepository")
 * @Vich\Uploadable()
 */
class Videos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $thumbnail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @var File
     * @Vich\UploadableField(mapping="document", fileNameProperty="documentFileName")
     */
    private $documentFile;

    /**
     * @var Document
     *
     * @ORM\OneToOne(
     *     targetEntity="App\Entity\Document",
     *     orphanRemoval=true,
     *     cascade={"persist", "remove"},
     * )
     * @ORM\JoinColumn(name="document_file_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $myDocument;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Preacher;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $views;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getDocumentFile()
    {
        return $this->documentFile;
    }


    public function getPreacher(): ?string
    {
        return $this->Preacher;
    }

    public function setPreacher(string $Preacher): self
    {
        $this->Preacher = $Preacher;

        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(?int $views): self
    {
        $this->views = $views;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

//    public function getMyDocument(): ?Document
//    {
//        return $this->myDocument;
//    }
//
//    public function setMyDocument(?Document $myDocument): self
//    {
//        $this->myDocument = $myDocument;
//
//        return $this;
//    }

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes={ "application/pdf", "video/mp4", "image/jpeg"})
     */
    private $brochure;

    public function getBrochure()
    {
        return $this->brochure;
    }

    public function setBrochure($brochure)
    {
        $this->brochure = $brochure;

        return $this;
    }
}
