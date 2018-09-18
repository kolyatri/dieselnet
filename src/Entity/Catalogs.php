<?php

namespace App\Entity;

use App\Entity\Maincats;


use Doctrine\ORM\Mapping as ORM;

/**
 * Catalogs
 *
 * @ORM\Table(name="catalogs")
 * @ORM\Entity
 */
class Catalogs
{
    /**
     * @var int
     *
     * @ORM\Column(name="catalog_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $catalogId;

    /**
     * @var string
     *
     * @ORM\Column(name="catalog_value", type="string", length=255, nullable=false)
     */
    private $catalogValue;

    /**
     * @var string
     *
     * @ORM\Column(name="catalog_name_en", type="string", length=255, nullable=false)
     */
    private $catalogNameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="catalog_name_he", type="string", length=255, nullable=false)
     */
    private $catalogNameHe;

    /**
     * @var string
     *
     * @ORM\Column(name="catalog_name_ru", type="string", length=255, nullable=false)
     */
    private $catalogNameRu;

    /**
     * @var string
     *
     * @ORM\Column(name="catalog_name_ar", type="string", length=255, nullable=false)
     */
    private $catalogNameAr;

    /**
     * @var int
     *
     * @ORM\Column(name="catalog_order", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $catalogOrder;

    /**
     * @var string
     *
     * @ORM\Column(name="catalog_picture", type="string", length=255, nullable=false)
     */
    private $catalogPicture;

    /**
     * @var array|null
     */
    private $catalogMaincats;

    public function getCatalogId(): ?int
    {
        return $this->catalogId;
    }

    public function getCatalogValue(): ?string
    {
        return $this->catalogValue;
    }

    public function setCatalogValue(string $catalogValue): self
    {
        $this->catalogValue = $catalogValue;

        return $this;
    }

    public function getCatalogNameEn(): ?string
    {
        return $this->catalogNameEn;
    }

    public function setCatalogNameEn(string $catalogNameEn): self
    {
        $this->catalogNameEn = $catalogNameEn;

        return $this;
    }

    public function getCatalogNameHe(): ?string
    {
        return $this->catalogNameHe;
    }

    public function setCatalogNameHe(string $catalogNameHe): self
    {
        $this->catalogNameHe = $catalogNameHe;

        return $this;
    }

    public function getCatalogNameRu(): ?string
    {
        return $this->catalogNameRu;
    }

    public function setCatalogNameRu(string $catalogNameRu): self
    {
        $this->catalogNameRu = $catalogNameRu;

        return $this;
    }

    public function getCatalogNameAr(): ?string
    {
        return $this->catalogNameAr;
    }

    public function setCatalogNameAr(string $catalogNameAr): self
    {
        $this->catalogNameAr = $catalogNameAr;

        return $this;
    }

    public function getCatalogOrder(): ?int
    {
        return $this->catalogOrder;
    }

    public function setCatalogOrder(int $catalogOrder): self
    {
        $this->catalogOrder = $catalogOrder;

        return $this;
    }

    public function getCatalogPicture(): ?string
    {
        return $this->catalogPicture;
    }

    public function setCatalogPicture(string $catalogPicture): self
    {
        $this->catalogPicture = $catalogPicture;

        return $this;
    }

    public function getCatalogMaincats(): ?array
    {
        return $this->catalogMaincats;
    }

    public function setCatalogMaincats(array $maincats): self
    {
        $this->catalogMaincats = $maincats;

        return $this;
    }

}
