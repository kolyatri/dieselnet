<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories", indexes={@ORM\Index(name="category_maincat_id", columns={"category_maincat_id"})})
 * @ORM\Entity
 */
class Categories
{
    /**
     * @var int
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $categoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="category_value", type="string", length=255, nullable=false)
     */
    private $categoryValue;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name_en", type="string", length=255, nullable=false)
     */
    private $categoryNameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name_he", type="string", length=255, nullable=false)
     */
    private $categoryNameHe;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name_ru", type="string", length=255, nullable=false)
     */
    private $categoryNameRu;

    /**
     * @var string
     *
     * @ORM\Column(name="category_name_ar", type="string", length=255, nullable=false)
     */
    private $categoryNameAr;

    /**
     * @var int
     *
     * @ORM\Column(name="category_order", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $categoryOrder;

    /**
     * @var \Maincats
     *
     * @ORM\ManyToOne(targetEntity="Maincats")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_maincat_id", referencedColumnName="maincat_id")
     * })
     */
    private $categoryMaincat;

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function getCategoryValue(): ?string
    {
        return $this->categoryValue;
    }

    public function setCategoryValue(string $categoryValue): self
    {
        $this->categoryValue = $categoryValue;

        return $this;
    }

    public function getCategoryNameEn(): ?string
    {
        return $this->categoryNameEn;
    }

    public function setCategoryNameEn(string $categoryNameEn): self
    {
        $this->categoryNameEn = $categoryNameEn;

        return $this;
    }

    public function getCategoryNameHe(): ?string
    {
        return $this->categoryNameHe;
    }

    public function setCategoryNameHe(string $categoryNameHe): self
    {
        $this->categoryNameHe = $categoryNameHe;

        return $this;
    }

    public function getCategoryNameRu(): ?string
    {
        return $this->categoryNameRu;
    }

    public function setCategoryNameRu(string $categoryNameRu): self
    {
        $this->categoryNameRu = $categoryNameRu;

        return $this;
    }

    public function getCategoryNameAr(): ?string
    {
        return $this->categoryNameAr;
    }

    public function setCategoryNameAr(string $categoryNameAr): self
    {
        $this->categoryNameAr = $categoryNameAr;

        return $this;
    }

    public function getCategoryOrder(): ?int
    {
        return $this->categoryOrder;
    }

    public function setCategoryOrder(int $categoryOrder): self
    {
        $this->categoryOrder = $categoryOrder;

        return $this;
    }

    public function getCategoryMaincat(): ?Maincats
    {
        return $this->categoryMaincat;
    }

    public function setCategoryMaincat(?Maincats $categoryMaincat): self
    {
        $this->categoryMaincat = $categoryMaincat;

        return $this;
    }


}
