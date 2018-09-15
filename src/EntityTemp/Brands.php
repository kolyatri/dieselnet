<?php

namespace App\EntityTemp;

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


}
