<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Models
 *
 * @ORM\Table(name="models", indexes={@ORM\Index(name="model_brand_id", columns={"model_brand_id"})})
 * @ORM\Entity
 */
class Models
{
    /**
     * @var int
     *
     * @ORM\Column(name="model_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $modelId;

    /**
     * @var string
     *
     * @ORM\Column(name="model_value", type="string", length=255, nullable=false)
     */
    private $modelValue;

    /**
     * @var string
     *
     * @ORM\Column(name="model_description", type="string", length=255, nullable=false)
     */
    private $modelDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="model_status", type="string", length=200, nullable=false, options={"default"="1","comment"="0 - disabled, 1 - enabled, 5- onhold, 8 - deleted"})
     */
    private $modelStatus = '1';

    /**
     * @var \Brands
     *
     * @ORM\ManyToOne(targetEntity="Brands")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="model_brand_id", referencedColumnName="brand_id")
     * })
     */
    private $modelBrand;


}
