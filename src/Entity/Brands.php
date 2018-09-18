<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Brands
 *
 * @ORM\Table(name="brands")
 * @ORM\Entity
 */
class Brands
{
    /**
     * @var int
     *
     * @ORM\Column(name="brand_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $brandId;

    /**
     * @var string
     *
     * @ORM\Column(name="brand_value", type="string", length=255, nullable=false)
     */
    private $brandValue;

    /**
     * @var string
     *
     * @ORM\Column(name="brand_name_en", type="string", length=255, nullable=false)
     */
    private $brandNameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="brand_name_he", type="string", length=255, nullable=false)
     */
    private $brandNameHe;

    /**
     * @var string
     *
     * @ORM\Column(name="brand_name_ru", type="string", length=255, nullable=false)
     */
    private $brandNameRu;

    /**
     * @var string
     *
     * @ORM\Column(name="brand_name_ar", type="string", length=255, nullable=false)
     */
    private $brandNameAr;

    /**
     * @var string
     *
     * @ORM\Column(name="brand_status", type="string", length=200, nullable=false, options={"default"="1","comment"="0 - disabled, 1 - enabled, 5- onhold, 8 - deleted"})
     */
    private $brandStatus = '1';

     /**
     * @var array|null     
     */
    private $brandModels;

    public function getBrandId(): ?int
    {
        return $this->brandId;
    }

    public function getBrandValue(): ?string
    {
        return $this->brandValue;
    }

    public function setBrandValue(string $brandValue): self
    {
        $this->brandValue = $brandValue;

        return $this;
    }

    public function getBrandNameEn(): ?string
    {
        return $this->brandNameEn;
    }

    public function setBrandNameEn(string $brandNameEn): self
    {
        $this->brandNameEn = $brandNameEn;

        return $this;
    }

    public function getBrandNameHe(): ?string
    {
        return $this->brandNameHe;
    }

    public function setBrandNameHe(string $brandNameHe): self
    {
        $this->brandNameHe = $brandNameHe;

        return $this;
    }

    public function getBrandNameRu(): ?string
    {
        return $this->brandNameRu;
    }

    public function setBrandNameRu(string $brandNameRu): self
    {
        $this->brandNameRu = $brandNameRu;

        return $this;
    }

    public function getBrandNameAr(): ?string
    {
        return $this->brandNameAr;
    }

    public function setBrandNameAr(string $brandNameAr): self
    {
        $this->brandNameAr = $brandNameAr;

        return $this;
    }

    public function getBrandStatus(): ?string
    {
        return $this->brandStatus;
    }

    public function setBrandStatus(string $brandStatus): self
    {
        $this->brandStatus = $brandStatus;

        return $this;
    }

    public function getBrandModels(): ?array
    {
        return $this->brandModels;
    }

    public function setBrandModels(array $brandModels): self
    {
        $this->brandModels = $brandModels;

        return $this;
    }
}
