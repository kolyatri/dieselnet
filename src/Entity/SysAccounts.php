<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * SysAccounts
 *
 * @ORM\Table(name="sys_accounts", indexes={@ORM\Index(name="account_password", columns={"account_password"}), @ORM\Index(name="account_account_type_id", columns={"account_account_type_id"}), @ORM\Index(name="account_country_id", columns={"account_country_id"})})
 * @ORM\Entity
 * @UniqueEntity(fields={"accountUniqueCode"}, message="accountUniqueCode must be unique")
 * @UniqueEntity(fields={"accountEmail"}, message="accountEmail must be unique")
 * @UniqueEntity(fields={"accountTelephone"}, message="accountTelephone must be unique")
 */
class SysAccounts
{
    public function __construct()
    {
        $this->setAccountCreatedOn(new \DateTime());
        $this->setAccountLastUpdate(new \DateTime());
        $this->setAccountStatus("0");
    }

    /**
     * @var int
     *
     * @ORM\Column(name="account_id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $accountId;
    
    /**
     * @var string
     * 
     * @Assert\NotBlank()
     * 
     * @ORM\Column(name="account_unique_code", type="string", length=5, nullable=false, unique=true)
     */
    private $accountUniqueCode;

    /**
     * @var string
     *
     * @ORM\Column(name="account_verify_code", type="string", length=255, nullable=true)
     */
    private $accountVerifyCode;

    /**
     * @var string
     *
     * @ORM\Column(name="account_api_token", type="string", length=255, nullable=true)
     */
    private $accountApiToken;

    /**
     * @var string
     *
     * @ORM\Column(name="account_vat", type="string", length=255, nullable=true)
     */
    private $accountVat;

    /**
     * @var string
     *
     * @Assert\NotBlank(groups={"updateOrRegistrate"})
     *
     * @ORM\Column(name="account_name", type="string", length=255, nullable=true)
     */
    private $accountName;

    /**
     * @var string
     *
     * @ORM\Column(name="account_url_name", type="string", length=255, nullable=true)
     */
    private $accountUrlName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * 
     * @ORM\Column(name="account_firstname", type="string", length=255, nullable=true)
     */
    private $accountFirstname;

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="account_lastname", type="string", length=255, nullable=true)
     */
    private $accountLastname;

    /**
     * @var string
     * 
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="account_address", type="string", length=255, nullable=true)
     */
    private $accountAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="account_city_place_id", type="string", length=255, nullable=true)
     */
    private $accountCityPlaceId;

    /**
     * @var string
     *
     * @ORM\Column(name="account_zipcode", type="string", length=255, nullable=true)
     */
    private $accountZipcode;

    /**
     * @var string
     * 
     * @Assert\NotBlank(groups={"startDemoRegistration"}) 
     * @Assert\Regex(
     *     pattern="/^\+\d{8,16}$/",
     *     match=true,
     *     message="Your telephone number is wrong",
     *     groups={"startDemoRegistration"}
     * )
     *
     * @ORM\Column(name="account_telephone", type="string", length=255, nullable=false, unique=true)
     */
    private $accountTelephone = "";

    /**
     * @var string
     *
     * @ORM\Column(name="account_fax", type="string", length=255, nullable=true)
     */
    private $accountFax;

    /**
     * @var string
     *
     * @ORM\Column(name="account_website", type="string", length=255, nullable=true)
     */
    private $accountWebsite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="account_logo", type="string", length=255, nullable=true)
     */
    private $accountLogo;

    /**
     * @var string
     *
     * @ORM\Column(name="account_about", type="text", length=65535, nullable=true)
     */
    private $accountAbout;

    /**
     * @var string|null
     *
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = false
     * )
     * 
     * @ORM\Column(name="account_email", type="string", length=255, nullable=true, unique=true)
     */
    private $accountEmail;

    /**
     * @var string
     * 
     * @Assert\NotBlank(groups={"passwordOriginal"})
     * @Assert\Length(
     *      min = 8,
     *      max = 20,
     *      groups={"passwordOriginal"}
     * )
     * 
     */
    private $accountPasswordOriginal = "";

    /**
     * @var string
     * 
     * @ORM\Column(name="account_password", type="string", length=80, nullable=true)
     */
    private $accountPassword;

    /**
     * @var string|null
     *
     * @ORM\Column(name="account_password_recreate_code", type="string", length=32, nullable=true)
     */
    private $accountPasswordRecreateCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="account_last_update", type="datetime", nullable=false)
     */
    private $accountLastUpdate;

    /**
     * @var string
     *
     * @ORM\Column(name="account_register_email_sent", type="string", length=200, nullable=false, options={"comment"="0=not sent, 1=sent"})
     */
    private $accountRegisterEmailSent = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="account_status", type="string", length=200, nullable=false, options={"comment"="0=inactive, 1=active, 2=onhold, 8=deleted"})
     */
    private $accountStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="account_created_on", type="datetime", nullable=false)
     */
    private $accountCreatedOn;

    /**
     * @var \AccountTypes
     *
     * @ORM\ManyToOne(targetEntity="AccountTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="account_account_type_id", referencedColumnName="account_type_id")
     * })
     */
    private $accountAccountType;

    /**
     * @var \Countries
     *
     * @ORM\ManyToOne(targetEntity="Countries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="account_country_id", referencedColumnName="country_id")
     * })
     */
    private $accountCountry;

    public function getAccountId(): ?int
    {
        return $this->accountId;
    }

    public function getAccountUniqueCode(): ?string
    {
        return $this->accountUniqueCode;
    }

    public function setAccountUniqueCode(string $accountUniqueCode): self
    {
        $this->accountUniqueCode = $accountUniqueCode;

        return $this;
    }

    public function getAccountVerifyCode(): ?string
    {
        return $this->accountVerifyCode;
    }

    public function setAccountVerifyCode(string $accountVerifyCode): self
    {
        $this->accountVerifyCode = $accountVerifyCode;

        return $this;
    }

    public function getAccountApiToken(): ?string
    {
        return $this->accountApiToken;
    }

    public function setAccountApiToken(string $accountApiToken): self
    {
        $this->accountApiToken = $accountApiToken;

        return $this;
    }

    public function getAccountVat(): ?string
    {
        return $this->accountVat;
    }

    public function setAccountVat(string $accountVat): self
    {
        $this->accountVat = $accountVat;

        return $this;
    }

    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    public function setAccountName(string $accountName): self
    {
        $this->accountName = $accountName;

        return $this;
    }

    public function getAccountUrlName(): ?string
    {
        return $this->accountUrlName;
    }

    public function setAccountUrlName(string $accountUrlName): self
    {
        $this->accountUrlName = $accountUrlName;

        return $this;
    }

    public function getAccountFirstname(): ?string
    {
        return $this->accountFirstname;
    }

    public function setAccountFirstname(string $accountFirstname): self
    {
        $this->accountFirstname = $accountFirstname;

        return $this;
    }

    public function getAccountLastname(): ?string
    {
        return $this->accountLastname;
    }

    public function setAccountLastname(string $accountLastname): self
    {
        $this->accountLastname = $accountLastname;

        return $this;
    }

    public function getAccountAddress(): ?string
    {
        return $this->accountAddress;
    }

    public function setAccountAddress(string $accountAddress): self
    {
        $this->accountAddress = $accountAddress;

        return $this;
    }

    public function getAccountCityPlaceId(): ?string
    {
        return $this->accountCityPlaceId;
    }

    public function setAccountCityPlaceId(string $accountCityPlaceId): self
    {
        $this->accountCityPlaceId = $accountCityPlaceId;

        return $this;
    }

    public function getAccountZipcode(): ?string
    {
        return $this->accountZipcode;
    }

    public function setAccountZipcode(string $accountZipcode): self
    {
        $this->accountZipcode = $accountZipcode;

        return $this;
    }

    public function getAccountTelephone(): ?string
    {
        return $this->accountTelephone;
    }

    public function setAccountTelephone(string $accountTelephone): self
    {
        $this->accountTelephone = $accountTelephone;

        return $this;
    }

    public function getAccountFax(): ?string
    {
        return $this->accountFax;
    }

    public function setAccountFax(string $accountFax): self
    {
        $this->accountFax = $accountFax;

        return $this;
    }

    public function getAccountWebsite(): ?string
    {
        return $this->accountWebsite;
    }

    public function setAccountWebsite(string $accountWebsite): self
    {
        $this->accountWebsite = $accountWebsite;

        return $this;
    }

    public function getAccountLogo(): ?string
    {
        return $this->accountLogo;
    }

    public function setAccountLogo(?string $accountLogo): self
    {
        $this->accountLogo = $accountLogo;

        return $this;
    }

    public function getAccountAbout(): ?string
    {
        return $this->accountAbout;
    }

    public function setAccountAbout(string $accountAbout): self
    {
        $this->accountAbout = $accountAbout;

        return $this;
    }

    public function getAccountEmail(): ?string
    {
        return $this->accountEmail;
    }

    public function setAccountEmail(?string $accountEmail): self
    {
        $this->accountEmail = $accountEmail;

        return $this;
    }

    public function getAccountPasswordOriginal(): ?string
    {
        return $this->accountPasswordOriginal;
    }

    public function setAccountPasswordOriginal(string $accountPasswordOriginal): self
    {
        $this->accountPasswordOriginal = $accountPasswordOriginal;

        return $this;
    }

    public function getAccountPassword(): ?string
    {
        return $this->accountPassword;
    }

    public function setAccountPassword(string $accountPassword): self
    {
        $this->accountPassword = $accountPassword;

        return $this;
    }

    public function getAccountPasswordRecreateCode(): ?string
    {
        return $this->accountPasswordRecreateCode;
    }

    public function setAccountPasswordRecreateCode(?string $accountPasswordRecreateCode): self
    {
        $this->accountPasswordRecreateCode = $accountPasswordRecreateCode;

        return $this;
    }

    public function getAccountLastUpdate(): ?string
    {
       return $this->accountLastUpdate->format('Y-m-d H:i:s');
    }

    public function setAccountLastUpdate(\DateTimeInterface $accountLastUpdate): self
    {
        $this->accountLastUpdate = $accountLastUpdate;

        return $this;
    }

    public function getAccountRegisterEmailSent(): ?string
    {
        return $this->accountRegisterEmailSent;
    }

    public function setAccountRegisterEmailSent(string $accountRegisterEmailSent): self
    {
        $this->accountRegisterEmailSent = $accountRegisterEmailSent;

        return $this;
    }

    public function getAccountStatus(): ?string
    {
        return $this->accountStatus;
    }

    public function setAccountStatus(string $accountStatus): self
    {
        $this->accountStatus = $accountStatus;

        return $this;
    }

    public function getAccountCreatedOn(): ?string
    {
        return $this->accountCreatedOn->format('Y-m-d H:i:s');
    }

    public function setAccountCreatedOn(\DateTimeInterface $accountCreatedOn): self
    {
        $this->accountCreatedOn = $accountCreatedOn;

        return $this;
    }

    public function getAccountAccountType(): ?AccountTypes
    {
        return $this->accountAccountType;
    }

    public function setAccountAccountType(?AccountTypes $accountAccountType): self
    {
        $this->accountAccountType = $accountAccountType;

        return $this;
    }

    public function getAccountCountry(): ?Countries
    {
        return $this->accountCountry;
    }

    public function setAccountCountry(?Countries $accountCountry): self
    {
        $this->accountCountry = $accountCountry;

        return $this;
    }


}
