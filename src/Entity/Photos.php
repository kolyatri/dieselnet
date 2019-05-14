<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photos
 *
 * @ORM\Table(name="photos", indexes={@ORM\Index(name="photo_account_id", columns={"photo_account_id"}), @ORM\Index(name="photo_ads_id", columns={"photo_ads_id"})})
 * @ORM\Entity
 */
class Photos
{
    /**
     * @var int
     *
     * @ORM\Column(name="photo_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $photoId;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_filename", type="string", length=255, nullable=false)
     */
    private $photoFilename;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_filename_ext", type="string", length=4, nullable=false)
     */
    private $photoFilenameExt;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_primary", type="string", length=1, nullable=false, options={"comment"="0=no,1=yes"})
     */
    private $photoPrimary = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="photo_created_on", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $photoCreatedOn = 'CURRENT_TIMESTAMP';

    /**
     * @var \SysAccounts
     *
     * @ORM\ManyToOne(targetEntity="SysAccounts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="photo_account_id", referencedColumnName="account_id")
     * })
     */
    private $photoAccount;

    /**
     * @var \Ads
     *
     * @ORM\ManyToOne(targetEntity="Ads")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="photo_ads_id", referencedColumnName="ads_id")
     * })
     */
    private $photoAds;


    /**
     * @var array
     */
    private $photoPhotoSizes;

    public function getPhotoId(): ?int
    {
        return $this->photoId;
    }

    public function getPhotoFilename(): ?string
    {
        return $this->photoFilename;
    }

    public function setPhotoFilename(string $photoFilename): self
    {
        $this->photoFilename = $photoFilename;

        return $this;
    }

    public function getPhotoFilenameExt(): ?string
    {
        return $this->photoFilenameExt;
    }

    public function setPhotoFilenameExt(string $photoFilenameExt): self
    {
        $this->photoFilenameExt = $photoFilenameExt;

        return $this;
    }

    public function getPhotoPrimary(): ?string
    {
        return $this->photoPrimary;
    }

    public function setPhotoPrimary(string $photoPrimary): self
    {
        $this->photoPrimary = $photoPrimary;

        return $this;
    }

    public function getPhotoCreatedOn(): ?string
    {
        return $this->photoCreatedOn->format('Y-m-d H:i:s');
       // return $this->photoCreatedOn;
    }

    public function setPhotoCreatedOn(\DateTimeInterface $photoCreatedOn): self
    {
        $this->photoCreatedOn = $photoCreatedOn;

        return $this;
    }

    public function getPhotoAccount(): ?SysAccounts
    {
        return $this->photoAccount;
    }

    public function setPhotoAccount(?SysAccounts $photoAccount): self
    {
        $this->photoAccount = $photoAccount;

        return $this;
    }

    public function getPhotoAds(): ?Ads
    {
        return $this->photoAds;
    }

    public function setPhotoAds(?Ads $photoAds): self
    {
        $this->photoAds = $photoAds;

        return $this;
    }

    public function getPhotoPhotoSizes(): ?array
    {
        return $this->photoPhotoSizes;
    }

    public function setPhotoPhotoSizes(?array $photoPhotoSizes): self
    {
        $this->photoPhotoSizes = $photoPhotoSizes;

        return $this;
    }

}
