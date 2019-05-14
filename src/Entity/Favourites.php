<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favourites
 *
 * @ORM\Table(name="favourites", indexes={@ORM\Index(name="favourites_account_id", columns={"favourites_account_id"}), @ORM\Index(name="favourites_ads_id", columns={"favourites_ads_id"})})
 * @ORM\Entity
 */
class Favourites
{
    /**
     * @var int
     *
     * @ORM\Column(name="favourites_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $favouritesId;

    /**
     * @var \Ads
     *
     * @ORM\ManyToOne(targetEntity="Ads")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="favourites_ads_id", referencedColumnName="ads_id")
     * })
     */
    private $favouritesAds;

    /**
     * @var \SysAccounts
     *
     * @ORM\ManyToOne(targetEntity="SysAccounts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="favourites_account_id", referencedColumnName="account_id")
     * })
     */
    private $favouritesAccount;

    public function getFavouritesId(): ?int
    {
        return $this->favouritesId;
    }

    public function getFavouritesAds(): ?Ads
    {
        return $this->favouritesAds;
    }

    public function setFavouritesAds(?Ads $favouritesAds): self
    {
        $this->favouritesAds = $favouritesAds;

        return $this;
    }

    public function getFavouritesAccount(): ?SysAccounts
    {
        return $this->favouritesAccount;
    }

    public function setFavouritesAccount(?SysAccounts $favouritesAccount): self
    {
        $this->favouritesAccount = $favouritesAccount;

        return $this;
    }


}
