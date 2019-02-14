<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Class Document
 *
 * @ORM\Table(name="document")
 * @ORM\Entity()
 * @Vich\Uploadable
 */
class Document
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $documentFileName;

    /**
     * @var File
     * @Vich\UploadableField(mapping="document", fileNameProperty="documentFileName")
     */
    private $documentFile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function setDocumentFile(File $document = null)
    {
        $this->documentFile = $document;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($document) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getDocumentFile()
    {
        return $this->documentFile;
    }

    public function setDocumentFilename($documentFilename)
    {
        $this->documentFileName = $documentFilename;
    }

    public function getDocumentFilename()
    {
        return $this->documentFileNameq ;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}