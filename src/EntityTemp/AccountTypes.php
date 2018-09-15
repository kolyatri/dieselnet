<?php

namespace App\EntityTemp;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccountTypes
 *
 * @ORM\Table(name="account_types")
 * @ORM\Entity
 */
class AccountTypes
{
    /**
     * @var int
     *
     * @ORM\Column(name="account_type_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $accountTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="account_type_value", type="string", length=255, nullable=false)
     */
    private $accountTypeValue;

    /**
     * @var string
     *
     * @ORM\Column(name="account_type_name_en", type="string", length=255, nullable=false)
     */
    private $accountTypeNameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="account_type_name_he", type="string", length=255, nullable=false)
     */
    private $accountTypeNameHe;

    /**
     * @var string
     *
     * @ORM\Column(name="account_type_name_ru", type="string", length=255, nullable=false)
     */
    private $accountTypeNameRu;

    /**
     * @var string
     *
     * @ORM\Column(name="account_type_name_ar", type="string", length=255, nullable=false)
     */
    private $accountTypeNameAr;

    /**
     * @var string
     *
     * @ORM\Column(name="account_type_status", type="string", length=200, nullable=false, options={"default"="1","comment"="0=inactive, 1=active"})
     */
    private $accountTypeStatus = '1';

    public function getAccountTypeId(): ?int
    {
        return $this->accountTypeId;
    }

    public function getAccountTypeValue(): ?string
    {
        return $this->accountTypeValue;
    }

    public function setAccountTypeValue(string $accountTypeValue): self
    {
        $this->accountTypeValue = $accountTypeValue;

        return $this;
    }

    public function getAccountTypeNameEn(): ?string
    {
        return $this->accountTypeNameEn;
    }

    public function setAccountTypeNameEn(string $accountTypeNameEn): self
    {
        $this->accountTypeNameEn = $accountTypeNameEn;

        return $this;
    }

    public function getAccountTypeNameHe(): ?string
    {
        return $this->accountTypeNameHe;
    }

    public function setAccountTypeNameHe(string $accountTypeNameHe): self
    {
        $this->accountTypeNameHe = $accountTypeNameHe;

        return $this;
    }

    public function getAccountTypeNameRu(): ?string
    {
        return $this->accountTypeNameRu;
    }

    public function setAccountTypeNameRu(string $accountTypeNameRu): self
    {
        $this->accountTypeNameRu = $accountTypeNameRu;

        return $this;
    }

    public function getAccountTypeNameAr(): ?string
    {
        return $this->accountTypeNameAr;
    }

    public function setAccountTypeNameAr(string $accountTypeNameAr): self
    {
        $this->accountTypeNameAr = $accountTypeNameAr;

        return $this;
    }

    public function getAccountTypeStatus(): ?string
    {
        return $this->accountTypeStatus;
    }

    public function setAccountTypeStatus(string $accountTypeStatus): self
    {
        $this->accountTypeStatus = $accountTypeStatus;

        return $this;
    }


}
