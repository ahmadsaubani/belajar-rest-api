<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 * 
 * @Vich\Uploadable
 */
class Image extends Media
{
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Assert\File(
     *  maxSize = "2048k",
     *  mimeTypes = {"image/*"},
     *  mimeTypesMessage = "Please upload a valid Image"
     * )
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName", size="imageSize")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $imageSize;

    /**
     * 
     * @Groups({"MediaFile"})
     */
    private $thumbnail;

    /**
     * 
     * @Groups({"MediaFile"})
     */
    private $small;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(?File $image = null): void
    {
        $this->imageFile = $image;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(int $imageSize): self
    {
        $this->imageSize = $imageSize;

        return $this;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }


    public function setThumbnail(string $thumbnail)
    {
        $this->thumbnail = $thumbnail;
        
        return $this;
    }

    public function getThumbnail()
    {
        return $this->thumbnail;
    }


    public function setSmall(string $small)
    {
        $this->small = $small;

        return $this;
    }

    public function getSmall()
    {
        return $this->small;
    }
}
