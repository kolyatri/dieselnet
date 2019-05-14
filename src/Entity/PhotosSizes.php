<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PhotosSizes
 *
 * @ORM\Table(name="photos_sizes", indexes={@ORM\Index(name="photo_size_photo_id", columns={"photo_size_photo_id"})})
 * @ORM\Entity
 */
class PhotosSizes
{
    /**
     * @var int
     *
     * @ORM\Column(name="photo_size_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $photoSizeId;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_size_width", type="string", length=255, nullable=false)
     */
    private $photoSizeWidth;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_size_height", type="string", length=255, nullable=false)
     */
    private $photoSizeHeight;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_size_file_name", type="string", length=255, nullable=false)
     */
    private $photoSizeFileName;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_size_appointment", type="string", length=255, nullable=false)
     */
    private $photoSizeAppointment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="photo_size_created_on", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $photoSizeCreatedOn = 'CURRENT_TIMESTAMP';

    /**
     * @var \Photos
     *
     * @ORM\ManyToOne(targetEntity="Photos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="photo_size_photo_id", referencedColumnName="photo_id")
     * })
     */
    private $photoSizePhoto;

    public function getPhotoSizeId(): ?int
    {
        return $this->photoSizeId;
    }

    public function getPhotoSizeWidth(): ?string
    {
        return $this->photoSizeWidth;
    }

    public function setPhotoSizeWidth(string $photoSizeWidth): self
    {
        $this->photoSizeWidth = $photoSizeWidth;

        return $this;
    }

    public function getPhotoSizeHeight(): ?string
    {
        return $this->photoSizeHeight;
    }

    public function setPhotoSizeHeight(string $photoSizeHeight): self
    {
        $this->photoSizeHeight = $photoSizeHeight;

        return $this;
    }

    public function getPhotoSizeFileName(): ?string
    {
        return $this->photoSizeFileName;
    }

    public function setPhotoSizeFileName(string $photoSizeFileName): self
    {
        $this->photoSizeFileName = $photoSizeFileName;

        return $this;
    }

    public function getPhotoSizeAppointment(): ?string
    {
        return $this->photoSizeAppointment;
    }

    public function setPhotoSizeAppointment(string $photoSizeAppointment): self
    {
        $this->photoSizeAppointment = $photoSizeAppointment;

        return $this;
    }

    public function getPhotoSizeCreatedOn(): ?string
    {
        return $this->photoSizeCreatedOn->format('Y-m-d H:i:s');
        //return $this->photoSizeCreatedOn;
    }

    public function setPhotoSizeCreatedOn(\DateTimeInterface $photoSizeCreatedOn): self
    {
        $this->photoSizeCreatedOn = $photoSizeCreatedOn;

        return $this;
    }

    public function getPhotoSizePhoto(): ?Photos
    {
        return $this->photoSizePhoto;
    }

    public function setPhotoSizePhoto(?Photos $photoSizePhoto): self
    {
        $this->photoSizePhoto = $photoSizePhoto;

        return $this;
    }


}
