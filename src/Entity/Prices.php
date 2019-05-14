<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prices
 *
 * @ORM\Table(name="prices", indexes={@ORM\Index(name="price_ads_id", columns={"price_ads_id"}), @ORM\Index(name="price_original_currency_id", columns={"price_original_currency_id"})})
 * @ORM\Entity
 */
class Prices
{
    /**
     * @var int
     *
     * @ORM\Column(name="price_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $priceId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="price_original_price", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $priceOriginalPrice;

    /**
     * @var int
     *
     * @ORM\Column(name="price_usd", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $priceUsd;

    /**
     * @var int
     *
     * @ORM\Column(name="price_eur", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $priceEur;

    /**
     * @var int
     *
     * @ORM\Column(name="price_ils", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $priceIls;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="price_updated_on", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $priceUpdatedOn = 'CURRENT_TIMESTAMP';

    /**
     * @var \Currencies
     *
     * @ORM\ManyToOne(targetEntity="Currencies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="price_original_currency_id", referencedColumnName="currency_id")
     * })
     */
    private $priceOriginalCurrency;

    /**
     * @var \Ads
     *
     * @ORM\ManyToOne(targetEntity="Ads")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="price_ads_id", referencedColumnName="ads_id")
     * })
     */
    private $priceAds;

    public function getPriceId(): ?int
    {
        return $this->priceId;
    }

    public function getPriceOriginalPrice(): ?int
    {
        return $this->priceOriginalPrice;
    }

    public function setPriceOriginalPrice(?int $priceOriginalPrice): self
    {
        $this->priceOriginalPrice = $priceOriginalPrice;

        return $this;
    }

    public function getPriceUsd(): ?int
    {
        return $this->priceUsd;
    }

    public function setPriceUsd(int $priceUsd): self
    {
        $this->priceUsd = $priceUsd;

        return $this;
    }

    public function getPriceEur(): ?int
    {
        return $this->priceEur;
    }

    public function setPriceEur(int $priceEur): self
    {
        $this->priceEur = $priceEur;

        return $this;
    }

    public function getPriceIls(): ?int
    {
        return $this->priceIls;
    }

    public function setPriceIls(int $priceIls): self
    {
        $this->priceIls = $priceIls;

        return $this;
    }

    public function getPriceUpdatedOn(): ?\DateTimeInterface
    {
        return $this->priceUpdatedOn;
    }

    public function setPriceUpdatedOn(\DateTimeInterface $priceUpdatedOn): self
    {
        $this->priceUpdatedOn = $priceUpdatedOn;

        return $this;
    }

    public function getPriceOriginalCurrency(): ?Currencies
    {
        return $this->priceOriginalCurrency;
    }

    public function setPriceOriginalCurrency(?Currencies $priceOriginalCurrency): self
    {
        $this->priceOriginalCurrency = $priceOriginalCurrency;

        return $this;
    }

    public function getPriceAds(): ?Ads
    {
        return $this->priceAds;
    }

    public function setPriceAds(?Ads $priceAds): self
    {
        $this->priceAds = $priceAds;

        return $this;
    }


}
