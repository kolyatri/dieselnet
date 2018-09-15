<?php

namespace App\EntityTemp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Countries
 *
 * @ORM\Table(name="countries")
 * @ORM\Entity
 */
class Countries
{
    /**
     * @var int
     *
     * @ORM\Column(name="country_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $countryId;

    /**
     * @var string
     *
     * @ORM\Column(name="country_slug", type="string", length=2, nullable=false)
     */
    private $countrySlug;

    /**
     * @var string
     *
     * @ORM\Column(name="country_name_en", type="string", length=255, nullable=false)
     */
    private $countryNameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="country_name_he", type="string", length=255, nullable=false)
     */
    private $countryNameHe;

    /**
     * @var string
     *
     * @ORM\Column(name="country_name_ru", type="string", length=255, nullable=false)
     */
    private $countryNameRu;

    /**
     * @var string
     *
     * @ORM\Column(name="country_name_ar", type="string", length=255, nullable=false)
     */
    private $countryNameAr;

    /**
     * @var string
     *
     * @ORM\Column(name="country_status", type="string", length=200, nullable=false, options={"comment"="0=hidden, 1=visible"})
     */
    private $countryStatus = '0';

    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    public function getCountrySlug(): ?string
    {
        return $this->countrySlug;
    }

    public function setCountrySlug(string $countrySlug): self
    {
        $this->countrySlug = $countrySlug;

        return $this;
    }

    public function getCountryNameEn(): ?string
    {
        return $this->countryNameEn;
    }

    public function setCountryNameEn(string $countryNameEn): self
    {
        $this->countryNameEn = $countryNameEn;

        return $this;
    }

    public function getCountryNameHe(): ?string
    {
        return $this->countryNameHe;
    }

    public function setCountryNameHe(string $countryNameHe): self
    {
        $this->countryNameHe = $countryNameHe;

        return $this;
    }

    public function getCountryNameRu(): ?string
    {
        return $this->countryNameRu;
    }

    public function setCountryNameRu(string $countryNameRu): self
    {
        $this->countryNameRu = $countryNameRu;

        return $this;
    }

    public function getCountryNameAr(): ?string
    {
        return $this->countryNameAr;
    }

    public function setCountryNameAr(string $countryNameAr): self
    {
        $this->countryNameAr = $countryNameAr;

        return $this;
    }

    public function getCountryStatus(): ?string
    {
        return $this->countryStatus;
    }

    public function setCountryStatus(string $countryStatus): self
    {
        $this->countryStatus = $countryStatus;

        return $this;
    }


}
