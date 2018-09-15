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


}
