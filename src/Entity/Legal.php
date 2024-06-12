<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Repository\LegalRepository")]
#[ORM\Table(name: "legal")]
class Legal
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type: "integer",options:["comment" => "Идентификатор"])]
    private $id;

    #[ORM\Column(type: "string", length: 255, options:["comment" => "Название юридического лица"])]
    private $name;

    #[ORM\Column(type: "string", length: 12, unique: true, options: ["comment" => "ИНН юридического лица"])]
    private $inn;

    #[ORM\Column(type: "string", length: 13, unique: true, options: ["comment" => "ОГРН юридического лица"])]
    private $ogrn;

    #[ORM\Column(type: "string", length: 9, options: ["comment" => "КПП юридического лица"])]
    private $kpp;

    #[ORM\Column(type: "string", length: 255, options: ["comment" => "Адрес юридического лица"])]
    private $address;

    #[ORM\Column(type: "string", length: 20, options: ["comment" => "Телефон юридического лица"])]
    private $phone;

    #[ORM\Column(type: "string", length: 255, options: ["comment" => "Электронная почта"])]
    private $email;

    #[ORM\Column(type: "date", options: ["comment" => "Дата регистрации"])]
    private $registrationDate;

    #[ORM\Column(type: "string", length: 255, options: ["comment" => "Форма собственности"])]
    private $ownershipForm;


    #[ORM\Column(type: "string", length: 255, options: ["comment" => "ФИО директора"])]
    private $director;


    #[ORM\Column(type: "string", length: 255, options: ["comment" => "ФИО главного бухгалтера"])]
    private $accountant;

    #[ORM\Column(type: "string", length: 255, nullable: true, options: ["comment" => "Наименование банка"])]
    private $bankName;

    #[ORM\Column(type: "string", length: 9, nullable: true, options: ["comment" => "Идентификационный код банка"])]
    private $bik;

    #[ORM\Column(type: "string", length: 20, nullable: true, options: ["comment" => "Корреспондентский счет"])]
    private $correspondentAccount;

    #[ORM\Column(type: "string", length: 20, nullable: true, options:["comment" => "Расчетный счет"])]
    private $checkingAccount;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getInn(): ?string
    {
        return $this->inn;
    }

    public function setInn(string $inn): self
    {
        $this->inn = $inn;

        return $this;
    }

    public function getOgrn(): ?string
    {
        return $this->ogrn;
    }

    public function setOgrn(string $ogrn): self
    {
        $this->ogrn = $ogrn;

        return $this;
    }

    public function getKpp(): ?string
    {
        return $this->kpp;
    }

    public function setKpp(string $kpp): self
    {
        $this->kpp = $kpp;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTimeInterface $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    public function getOwnershipForm(): ?string
    {
        return $this->ownershipForm;
    }

    public function setOwnershipForm(string $ownershipForm): self
    {
        $this->ownershipForm = $ownershipForm;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(string $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function getAccountant(): ?string
    {
        return $this->accountant;
    }

    public function setAccountant(string $accountant): self
    {
        $this->accountant = $accountant;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * @param mixed $bankName
     */
    public function setBankName($bankName): void
    {
        $this->bankName = $bankName;
    }

    /**
     * @return mixed
     */
    public function getBik()
    {
        return $this->bik;
    }

    /**
     * @param mixed $bik
     */
    public function setBik($bik): void
    {
        $this->bik = $bik;
    }

    /**
     * @return mixed
     */
    public function getCorrespondentAccount()
    {
        return $this->correspondentAccount;
    }

    /**
     * @param mixed $correspondentAccount
     */
    public function setCorrespondentAccount($correspondentAccount): void
    {
        $this->correspondentAccount = $correspondentAccount;
    }

    /**
     * @return mixed
     */
    public function getCheckingAccount()
    {
        return $this->checkingAccount;
    }

    /**
     * @param mixed $checkingAccount
     */
    public function setCheckingAccount($checkingAccount): void
    {
        $this->checkingAccount = $checkingAccount;
    }
}
