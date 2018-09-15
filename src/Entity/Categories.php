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


}
