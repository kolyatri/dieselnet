<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visits
 *
 * @ORM\Table(name="visits", indexes={@ORM\Index(name="visit_ads_id", columns={"visit_ads_id"})})
 * @ORM\Entity
 */
class Visits
{
    /**
     * @var int
     *
     * @ORM\Column(name="visit_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $visitId;

    /**
     * @var string
     *
     * @ORM\Column(name="visit_ip", type="string", length=15, nullable=false)
     */
    private $visitIp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visit_date", type="date", nullable=false)
     */
    private $visitDate;

    /**
     * @var \Ads
     *
     * @ORM\ManyToOne(targetEntity="Ads")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="visit_ads_id", referencedColumnName="ads_id")
     * })
     */
    private $visitAds;

    public function getVisitId(): ?int
    {
        return $this->visitId;
    }

    public function getVisitIp(): ?string
    {
        return $this->visitIp;
    }

    public function setVisitIp(string $visitIp): self
    {
        $this->visitIp = $visitIp;

        return $this;
    }

    public function getVisitDate(): ?string
    {
        return $this->visitDate->format('Y-m-d H:i:s');
    }

    public function setVisitDate(\DateTimeInterface $visitDate): self
    {
        $this->visitDate = $visitDate;

        return $this;
    }

    public function getVisitAds(): ?Ads
    {
        return $this->visitAds;
    }

    public function setVisitAds(?Ads $visitAds): self
    {
        $this->visitAds = $visitAds;

        return $this;
    }


}
