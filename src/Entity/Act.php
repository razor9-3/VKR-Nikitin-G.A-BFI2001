<?php
namespace App\Entity;

use App\Repository\ActRepository;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
#[ORM\Entity(repositoryClass: ActRepository::class)]
#[ORM\Index(name: "contract_id_idx1", columns:["contract_id"])]
#[ORM\Index(name: "contract_id_idx2", fields:["contract"])]
class Act
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer", options:["unsigned" => true, "comment" => "Идентификатор"])]
    private int $id;

    #[ORM\Column(name: "contract_id", type:"integer", options:["unsigned" => true, "comment" => "Номер договора"])]
    #[ORM\JoinColumn(name: "contract_id", referencedColumnName: "id")]
    #[ORM\ManyToOne(targetEntity: Contract::class)]
    private Contract $contract;

    #[ORM\Column(type:"string", options:["comment" => "ФИО покупателя"])]
    private string $buyer;

    #[ORM\Column(type:"string", options:["comment" => "ФИО продавца"])]
    private string $seller;

    #[ORM\Column(type:"string", options:["comment" => "Марка"])]
    private string $vehicleBrand;

    #[ORM\Column(type:"string", options:["comment" => "Модель"])]
    private string $vehicleModel;

    #[ORM\Column(type:"date", options:["comment" => "Дата изготовления"])]
    private ?DateTime $yearOfManufacture;

    #[ORM\Column(type:"string", length:4, options:["comment" => "Серия ПТС"])]
    private string $passportSeries;

    #[ORM\Column(type:"integer", length:6, options:["comment" => "Номер ПТС"])]
    private $passportNumber;

    #[ORM\Column(type:"date", options:["comment" => "Дата выдачи ПТС"])]
    private ?DateTime $passportDate;

    #[ORM\Column(type:"string", length:17, options:["comment" => "Идентификационный номер транспорта"])]
    private string $vin;

    #[ORM\Column(type:"string", length:17, options:["comment" => "Номер кузова"])]
    private $bodyworkNumber;

    #[ORM\Column(type:"string", options:["comment" => "Номер двигателя"])]
    private $engineNumber;

    #[ORM\Column(type:"string", options:["comment" => "Цвет кузова"])]
    private string $vehicleColor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContract(): int
    {
        return $this->contract;
    }

    public function setContract(int $contract): void
    {
        $this->contract = $contract;
    }

    public function getBuyer(): string
    {
        return $this->buyer;
    }

    public function setBuyer(string $buyer): void
    {
        $this->buyer = $buyer;
    }

    public function getSeller(): string
    {
        return $this->seller;
    }

    public function setSeller(string $seller): void
    {
        $this->seller = $seller;
    }

    public function getVehicleBrand(): string
    {
        return $this->vehicleBrand;
    }

    public function setVehicleBrand(string $vehicleBrand): void
    {
        $this->vehicleBrand = $vehicleBrand;
    }

    public function getVehicleModel(): string
    {
        return $this->vehicleModel;
    }

    public function setVehicleModel(string $vehicleModel): void
    {
        $this->vehicleModel = $vehicleModel;
    }

    public function getYearOfManufacture(): ?DateTime
    {
        return $this->yearOfManufacture;
    }

    public function setYearOfManufacture(?DateTime $yearOfManufacture): void
    {
        $this->yearOfManufacture = $yearOfManufacture;
    }

    public function getPassportSeries(): string
    {
        return $this->passportSeries;
    }

    public function setPassportSeries(string $passportSeries): void
    {
        $this->passportSeries = $passportSeries;
    }

    /**
     * @return mixed
     */
    public function getPassportNumber()
    {
        return $this->passportNumber;
    }

    /**
     * @param mixed $passportNumber
     */
    public function setPassportNumber($passportNumber): void
    {
        $this->passportNumber = $passportNumber;
    }

    public function getPassportDate(): string
    {
        return $this->passportDate;
    }

    public function setPassportDate(string $passportDate): void
    {
        $this->passportDate = $passportDate;
    }

    public function getVin(): string
    {
        return $this->vin;
    }

    public function setVin(string $vin): void
    {
        $this->vin = $vin;
    }

    /**
     * @return mixed
     */
    public function getBodyworkNumber()
    {
        return $this->bodyworkNumber;
    }

    /**
     * @param mixed $bodyworkNumber
     */
    public function setBodyworkNumber($bodyworkNumber): void
    {
        $this->bodyworkNumber = $bodyworkNumber;
    }

    /**
     * @return mixed
     */
    public function getEngineNumber()
    {
        return $this->engineNumber;
    }

    /**
     * @param mixed $engineNumber
     */
    public function setEngineNumber($engineNumber): void
    {
        $this->engineNumber = $engineNumber;
    }

    public function getVehicleColor(): string
    {
        return $this->vehicleColor;
    }

    public function setVehicleColor(string $vehicleColor): void
    {
        $this->vehicleColor = $vehicleColor;
    }

}
