<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Currencies
 *
 * @ORM\Table(name="currencies")
 * @ORM\Entity
 */
class Currencies
{
    /**
     * @var int
     *
     * @ORM\Column(name="currency_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $currencyId;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_code", type="string", length=255, nullable=false)
     */
    private $currencyCode;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_name_en", type="string", length=255, nullable=false)
     */
    private $currencyNameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_name_he", type="string", length=255, nullable=false)
     */
    private $currencyNameHe;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_name_ru", type="string", length=255, nullable=false)
     */
    private $currencyNameRu;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_name_ar", type="string", length=255, nullable=false)
     */
    private $currencyNameAr;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_symbol", type="string", length=255, nullable=false)
     */
    private $currencySymbol;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_symbol_utf", type="string", length=255, nullable=false)
     */
    private $currencySymbolUtf;

    public function getCurrencyId(): ?int
    {
        return $this->currencyId;
    }

    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    public function setCurrencyCode(string $currencyCode): self
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    public function getCurrencyNameEn(): ?string
    {
        return $this->currencyNameEn;
    }

    public function setCurrencyNameEn(string $currencyNameEn): self
    {
        $this->currencyNameEn = $currencyNameEn;

        return $this;
    }

    public function getCurrencyNameHe(): ?string
    {
        return $this->currencyNameHe;
    }

    public function setCurrencyNameHe(string $currencyNameHe): self
    {
        $this->currencyNameHe = $currencyNameHe;

        return $this;
    }

    public function getCurrencyNameRu(): ?string
    {
        return $this->currencyNameRu;
    }

    public function setCurrencyNameRu(string $currencyNameRu): self
    {
        $this->currencyNameRu = $currencyNameRu;

        return $this;
    }

    public function getCurrencyNameAr(): ?string
    {
        return $this->currencyNameAr;
    }

    public function setCurrencyNameAr(string $currencyNameAr): self
    {
        $this->currencyNameAr = $currencyNameAr;

        return $this;
    }

    public function getCurrencySymbol(): ?string
    {
        return $this->currencySymbol;
    }

    public function setCurrencySymbol(string $currencySymbol): self
    {
        $this->currencySymbol = $currencySymbol;

        return $this;
    }

    public function getCurrencySymbolUtf(): ?string
    {
        return $this->currencySymbolUtf;
    }

    public function setCurrencySymbolUtf(string $currencySymbolUtf): self
    {
        $this->currencySymbolUtf = $currencySymbolUtf;

        return $this;
    }


}
