<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Maincats
 *
 * @ORM\Table(name="maincats", indexes={@ORM\Index(name="maincat_catalog_id", columns={"maincat_catalog_id"})})
 * @ORM\Entity
 */
class Maincats
{
    /**
     * @var int
     *
     * @ORM\Column(name="maincat_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $maincatId;

    /**
     * @var string
     *
     * @ORM\Column(name="maincat_value", type="string", length=255, nullable=false)
     */
    private $maincatValue;

    /**
     * @var string
     *
     * @ORM\Column(name="maincat_name_en", type="string", length=255, nullable=false)
     */
    private $maincatNameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="maincat_name_he", type="string", length=255, nullable=false)
     */
    private $maincatNameHe;

    /**
     * @var string
     *
     * @ORM\Column(name="maincat_name_ru", type="string", length=255, nullable=false)
     */
    private $maincatNameRu;

    /**
     * @var string
     *
     * @ORM\Column(name="maincat_name_ar", type="string", length=255, nullable=false)
     */
    private $maincatNameAr;

    /**
     * @var int
     *
     * @ORM\Column(name="maincat_order", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $maincatOrder;

    /**
     * @var \Catalogs
     *
     * @ORM\ManyToOne(targetEntity="Catalogs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="maincat_catalog_id", referencedColumnName="catalog_id")
     * })
     */
    private $maincatCatalog;

    /**
     * @var array|null
     */
    private $maincatCategories;

    public function getMaincatId(): ?int
    {
        return $this->maincatId;
    }

    public function getMaincatValue(): ?string
    {
        return $this->maincatValue;
    }

    public function setMaincatValue(string $maincatValue): self
    {
        $this->maincatValue = $maincatValue;

        return $this;
    }

    public function getMaincatNameEn(): ?string
    {
        return $this->maincatNameEn;
    }

    public function setMaincatNameEn(string $maincatNameEn): self
    {
        $this->maincatNameEn = $maincatNameEn;

        return $this;
    }

    public function getMaincatNameHe(): ?string
    {
        return $this->maincatNameHe;
    }

    public function setMaincatNameHe(string $maincatNameHe): self
    {
        $this->maincatNameHe = $maincatNameHe;

        return $this;
    }

    public function getMaincatNameRu(): ?string
    {
        return $this->maincatNameRu;
    }

    public function setMaincatNameRu(string $maincatNameRu): self
    {
        $this->maincatNameRu = $maincatNameRu;

        return $this;
    }

    public function getMaincatNameAr(): ?string
    {
        return $this->maincatNameAr;
    }

    public function setMaincatNameAr(string $maincatNameAr): self
    {
        $this->maincatNameAr = $maincatNameAr;

        return $this;
    }

    public function getMaincatOrder(): ?int
    {
        return $this->maincatOrder;
    }

    public function setMaincatOrder(int $maincatOrder): self
    {
        $this->maincatOrder = $maincatOrder;

        return $this;
    }

    public function getMaincatCatalog(): ?Catalogs
    {
        return $this->maincatCatalog;
    }

    public function setMaincatCatalog(?Catalogs $maincatCatalog): self
    {
        $this->maincatCatalog = $maincatCatalog;

        return $this;
    }

    public function getMaincatCategories(): ?array
    {
        return $this->maincatCategories;
    }

    public function setMaincatCategories(array $maincatCategories): self
    {
        $this->maincatCategories = $maincatCategories;

        return $this;
    }
}
