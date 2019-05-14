<?php

namespace App\Entity;

use App\Entity\Photos;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ads
 *
 * @ORM\Table(name="ads", indexes={@ORM\Index(name="ads_account_id", columns={"ads_account_id"}), @ORM\Index(name="ads_catalog_id", columns={"ads_catalog_id"}), @ORM\Index(name="ads_maincat_id", columns={"ads_maincat_id"}), @ORM\Index(name="ads_category_id", columns={"ads_category_id"}), @ORM\Index(name="ads_brand_id", columns={"ads_brand_id"}), @ORM\Index(name="ads_model_id", columns={"ads_model_id"}), @ORM\Index(name="ads_country_id", columns={"ads_country_id"})})
 * @ORM\Entity
 */
class Ads
{
    /**
     * @var int
     *
     * @ORM\Column(name="ads_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $adsId;

    /**
     * @var string
     *
     * @ORM\Column(name="ads_type_id", type="string", length=1, nullable=false, options={"default"="1","comment"="1=sell, 2=rent"})
     */
    private $adsTypeId = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="ads_exchange_opportunity", type="string", length=1, nullable=false, options={"comment"="0=no, 1=yes"})
     */
    private $adsExchangeOpportunity = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ads_machine_location_place_id", type="string", length=255, nullable=false)
     */
    private $adsMachineLocationPlaceId;

    /**
     * @var string
     *
     * @ORM\Column(name="ads_machine_location", type="string", length=255, nullable=false)
     */
    private $adsMachineLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="ads_is_best_offer", type="string", length=1, nullable=false, options={"comment"="0 or 1"})
     */
    private $adsIsBestOffer = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="ads_year", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $adsYear;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ads_hours", type="string", length=255, nullable=true)
     */
    private $adsHours;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ads_owners_count", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $adsOwnersCount;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ads_condition", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $adsCondition;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ads_mileage", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $adsMileage;

    /**
     * @var string
     *
     * @ORM\Column(name="ads_air_conditioning", type="string", length=1, nullable=false, options={"comment"="0=no, 1=yes"})
     */
    private $adsAirConditioning = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ads_original_color", type="string", length=1, nullable=false, options={"default"="1","comment"="0=no, 1=yes"})
     */
    private $adsOriginalColor = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="ads_other_information", type="text", length=65535, nullable=true)
     */
    private $adsOtherInformation;

    /**
     * @var string
     *
     * @ORM\Column(name="ads_price_negotiable", type="string", length=1, nullable=false, options={"comment"="0=no, 1=yes"})
     */
    private $adsPriceNegotiable = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ads_rent_by_period", type="string", length=255, nullable=false)
     */
    private $adsRentByPeriod;

    /**
     * @var string
     *
     * @ORM\Column(name="ads_search_string", type="text", length=65535, nullable=false)
     */
    private $adsSearchString;

    /**
     * @var string
     *
     * @ORM\Column(name="ads_status", type="string", length=1, nullable=false, options={"default"="1","comment"="0, 1, or 8"})
     */
    private $adsStatus = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ads_publish_date", type="datetime", nullable=false)
     */
    private $adsPublishDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ads_last_update", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $adsLastUpdate = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ads_created_on", type="datetime", nullable=false)
     */
    private $adsCreatedOn;

    /**
     * @var \SysAccounts
     *
     * @ORM\ManyToOne(targetEntity="SysAccounts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ads_account_id", referencedColumnName="account_id")
     * })
     */
    private $adsAccount;

    /**
     * @var \Catalogs
     *
     * @ORM\ManyToOne(targetEntity="Catalogs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ads_catalog_id", referencedColumnName="catalog_id")
     * })
     */
    private $adsCatalog;

    /**
     * @var \Maincats
     *
     * @ORM\ManyToOne(targetEntity="Maincats")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ads_maincat_id", referencedColumnName="maincat_id")
     * })
     */
    private $adsMaincat;

    /**
     * @var \Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ads_category_id", referencedColumnName="category_id")
     * })
     */
    private $adsCategory;

    /**
     * @var \Brands
     *
     * @ORM\ManyToOne(targetEntity="Brands")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ads_brand_id", referencedColumnName="brand_id")
     * })
     */
    private $adsBrand;

    /**
     * @var \Models
     *
     * @ORM\ManyToOne(targetEntity="Models")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ads_model_id", referencedColumnName="model_id")
     * })
     */
    private $adsModel;

    /**
     * @var \Countries
     *
     * @ORM\ManyToOne(targetEntity="Countries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ads_country_id", referencedColumnName="country_id")
     * })
     */
    private $adsCountry;

    /**
     * @var int
     */
    private $adsVisitsCount;

    /**
     * @var int
     */
    private $adsFavouritesCount;

    /**
     * @var bool
     */
    private $adsIsFavourited;

    /**
     * @var Photos
     */
    private $adsPrimaryPhoto;

    /**
     * @var array
     */
    private $adsPhotos;

    public function getAdsId(): ?int
    {
        return $this->adsId;
    }

    public function getAdsTypeId(): ?string
    {
        return $this->adsTypeId;
    }

    public function setAdsTypeId(string $adsTypeId): self
    {
        $this->adsTypeId = $adsTypeId;

        return $this;
    }

    public function getAdsExchangeOpportunity(): ?string
    {
        return $this->adsExchangeOpportunity;
    }

    public function setAdsExchangeOpportunity(string $adsExchangeOpportunity): self
    {
        $this->adsExchangeOpportunity = $adsExchangeOpportunity;

        return $this;
    }

    public function getAdsMachineLocationPlaceId(): ?string
    {
        return $this->adsMachineLocationPlaceId;
    }

    public function setAdsMachineLocationPlaceId(string $adsMachineLocationPlaceId): self
    {
        $this->adsMachineLocationPlaceId = $adsMachineLocationPlaceId;

        return $this;
    }

    public function getAdsMachineLocation(): ?string
    {
        return $this->adsMachineLocation;
    }

    public function setAdsMachineLocation(string $adsMachineLocation): self
    {
        $this->adsMachineLocation = $adsMachineLocation;

        return $this;
    }

    public function getAdsIsBestOffer(): ?string
    {
        return $this->adsIsBestOffer;
    }

    public function setAdsIsBestOffer(string $adsIsBestOffer): self
    {
        $this->adsIsBestOffer = $adsIsBestOffer;

        return $this;
    }

    public function getAdsYear(): ?int
    {
        return $this->adsYear;
    }

    public function setAdsYear(int $adsYear): self
    {
        $this->adsYear = $adsYear;

        return $this;
    }

    public function getAdsHours(): ?string
    {
        return $this->adsHours;
    }

    public function setAdsHours(?string $adsHours): self
    {
        $this->adsHours = $adsHours;

        return $this;
    }

    public function getAdsOwnersCount(): ?int
    {
        return $this->adsOwnersCount;
    }

    public function setAdsOwnersCount(?int $adsOwnersCount): self
    {
        $this->adsOwnersCount = $adsOwnersCount;

        return $this;
    }

    public function getAdsCondition(): ?int
    {
        return $this->adsCondition;
    }

    public function setAdsCondition(?int $adsCondition): self
    {
        $this->adsCondition = $adsCondition;

        return $this;
    }

    public function getAdsMileage(): ?int
    {
        return $this->adsMileage;
    }

    public function setAdsMileage(?int $adsMileage): self
    {
        $this->adsMileage = $adsMileage;

        return $this;
    }

    public function getAdsAirConditioning(): ?string
    {
        return $this->adsAirConditioning;
    }

    public function setAdsAirConditioning(string $adsAirConditioning): self
    {
        $this->adsAirConditioning = $adsAirConditioning;

        return $this;
    }

    public function getAdsOriginalColor(): ?string
    {
        return $this->adsOriginalColor;
    }

    public function setAdsOriginalColor(string $adsOriginalColor): self
    {
        $this->adsOriginalColor = $adsOriginalColor;

        return $this;
    }

    public function getAdsOtherInformation(): ?string
    {
        return $this->adsOtherInformation;
    }

    public function setAdsOtherInformation(?string $adsOtherInformation): self
    {
        $this->adsOtherInformation = $adsOtherInformation;

        return $this;
    }

    public function getAdsPriceNegotiable(): ?string
    {
        return $this->adsPriceNegotiable;
    }

    public function setAdsPriceNegotiable(string $adsPriceNegotiable): self
    {
        $this->adsPriceNegotiable = $adsPriceNegotiable;

        return $this;
    }

    public function getAdsRentByPeriod(): ?string
    {
        return $this->adsRentByPeriod;
    }

    public function setAdsRentByPeriod(string $adsRentByPeriod): self
    {
        $this->adsRentByPeriod = $adsRentByPeriod;

        return $this;
    }

    public function getAdsSearchString(): ?string
    {
        return $this->adsSearchString;
    }

    public function setAdsSearchString(string $adsSearchString): self
    {
        $this->adsSearchString = $adsSearchString;

        return $this;
    }

    public function getAdsStatus(): ?string
    {
        return $this->adsStatus;
    }

    public function setAdsStatus(string $adsStatus): self
    {
        $this->adsStatus = $adsStatus;

        return $this;
    }

    public function getAdsPublishDate(): ?string
    {
        return $this->adsPublishDate->format('Y-m-d H:i:s');
        //return $this->adsPublishDate;
    }

    public function setAdsPublishDate(\DateTimeInterface $adsPublishDate): self
    {
        $this->adsPublishDate = $adsPublishDate;

        return $this;
    }

    public function getAdsLastUpdate(): ?string
    {
        return $this->adsLastUpdate->format('Y-m-d H:i:s');
        //return $this->adsLastUpdate;
    }

    public function setAdsLastUpdate(\DateTimeInterface $adsLastUpdate): self
    {
        $this->adsLastUpdate = $adsLastUpdate;

        return $this;
    }

    public function getAdsCreatedOn(): ?string
    {
        return $this->adsCreatedOn->format('Y-m-d H:i:s');
        //return $this->adsCreatedOn;
    }

    public function setAdsCreatedOn(\DateTimeInterface $adsCreatedOn): self
    {
        $this->adsCreatedOn = $adsCreatedOn;

        return $this;
    }

    public function getAdsAccount(): ?SysAccounts
    {
        return $this->adsAccount;
    }

    public function setAdsAccount(?SysAccounts $adsAccount): self
    {
        $this->adsAccount = $adsAccount;

        return $this;
    }

    public function getAdsCatalog(): ?Catalogs
    {
        return $this->adsCatalog;
    }

    public function setAdsCatalog(?Catalogs $adsCatalog): self
    {
        $this->adsCatalog = $adsCatalog;

        return $this;
    }

    public function getAdsMaincat(): ?Maincats
    {
        return $this->adsMaincat;
    }

    public function setAdsMaincat(?Maincats $adsMaincat): self
    {
        $this->adsMaincat = $adsMaincat;

        return $this;
    }

    public function getAdsCategory(): ?Categories
    {
        return $this->adsCategory;
    }

    public function setAdsCategory(?Categories $adsCategory): self
    {
        $this->adsCategory = $adsCategory;

        return $this;
    }

    public function getAdsBrand(): ?Brands
    {
        return $this->adsBrand;
    }

    public function setAdsBrand(?Brands $adsBrand): self
    {
        $this->adsBrand = $adsBrand;

        return $this;
    }

    public function getAdsModel(): ?Models
    {
        return $this->adsModel;
    }

    public function setAdsModel(?Models $adsModel): self
    {
        $this->adsModel = $adsModel;

        return $this;
    }

    public function getAdsCountry(): ?Countries
    {
        return $this->adsCountry;
    }

    public function setAdsCountry(?Countries $adsCountry): self
    {
        $this->adsCountry = $adsCountry;

        return $this;
    }

    public function getAdsVisitsCount(): ?int
    {
        return $this->adsVisitsCount;
    }

    public function setAdsVisitsCount(int $adsVisitsCount): self
    {
        $this->adsVisitsCount = $adsVisitsCount;

        return $this;
    }

    public function getAdsFavouritesCount(): ?int
    {
        return $this->adsFavouritesCount;
    }

    public function setAdsFavouritesCount(int $adsFavouritesCount): self
    {
        $this->adsFavouritesCount = $adsFavouritesCount;

        return $this;
    }

    public function getAdsIsFavourited(): ?bool
    {
        return $this->adsIsFavourited;
    }

    public function setAdsIsFavourited(bool $adsIsFavourited): self
    {
        $this->adsIsFavourited = $adsIsFavourited;

        return $this;
    }

    public function getAdsPrimaryPhoto(): ?Photos
    {
        return $this->adsPrimaryPhoto;
    }

    /**
     * @param Photos|null $adsPrimaryPhoto
     */
    public function setAdsPrimaryPhoto($adsPrimaryPhoto): self
    {
        $this->adsPrimaryPhoto = $adsPrimaryPhoto;

        return $this;
    }

    public function getAdsPhotos(): ?array
    {
        return $this->adsPhotos;
    }

    /**
     * @param array|null $adsPhotos
     */
    public function setAdsPhotos($adsPhotos): self
    {
        $this->adsPhotos = $adsPhotos;

        return $this;
    }


}
