<?php

namespace App\EntityTemp;

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


}
