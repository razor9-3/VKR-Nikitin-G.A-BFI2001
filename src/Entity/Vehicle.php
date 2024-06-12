<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer", options:["unsigned" => true, "comment" => "Идентификатор"])]
    private int $id;

    #[ORM\Column(type:"string", length:17, options:["comment" => "Идентификационный номер транспорта"])]
    private string $vin;

    #[ORM\Column(type:"string", options:["comment" => "Марка"])]
    private string $vehicleBrand;

    #[ORM\Column(type:"string", options:["comment" => "Модель"])]
    private string $vehicleModel;

    #[ORM\Column(type:"string", options:["comment" => "Тип транспорта"])]
    private string $type;

    #[ORM\Column(type:"string", options:["comment" => "Категория транспорта"])]
    private string $category;

    #[ORM\Column(type:"date", options:["comment" => "Дата изготовления"])]
    private \DateTime $yearOfManufacture;

    #[ORM\Column(type:"string", options:["comment" => "Модель двигателя"])]
    private string $engineModel;

    #[ORM\Column(type:"string", options:["comment" => "Номер двигателя"])]
    private string $engineNumber;

    #[ORM\Column(type:"string", options:["comment" => "Номер шасси"])]
    private string $chassisNumber;

    #[ORM\Column(type:"string", length:17, options:["comment" => "Номер кузова"])]
    private string $bodyworkNumber;

    #[ORM\Column(type:"string", options:["comment" => "Цвет кузова"])]
    private string $vehicleColor;

    #[ORM\Column(type:"integer", options:["unsigned" => true, "comment" => "Мощность двигателя"])]
    private int $enginePower;

    #[ORM\Column(type:"integer", options:["unsigned" => true, "comment" => "Объём двигателя"])]
    private int $engineCapacity;

    #[ORM\Column(type:"string", options:["comment" => "Тип двигателя"])]
    private string $engineType;

    #[ORM\Column(type:"integer", options:["unsigned" => true, "comment" => "Масса без нагрузки"])]
    private int $mass;

    #[ORM\Column(type:"string", options:["comment" => "Организация-изготовитель"])]
    private string $manufacturer;

    #[ORM\Column(type:"datetime", options:["comment" => "Дата поступления на склад"])]
    private \DateTime $inDate;

    #[ORM\Column(type:"datetime", nullable: true,options:["comment" => "Дата отгрузки"])]
    private \DateTime $outDate;

    #[ORM\Column(type:"integer",nullable: true, options:["unsigned" => true, "comment" => "Статус. 1 - доступен к продаже, 2 - забронирован, 3 - отгружен", "default"=>1])]
    private int $status;


//    #[ORM\Column(name:"contract_item_id",type:"integer", options:["null"=>true])]
    #[ORM\OneToOne(targetEntity: ContractItem::class, inversedBy: "vehicle", cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: true)]
    private ContractItem $contractItem;

    #[ORM\ManyToOne(targetEntity: Article::class, inversedBy: 'vehicle')]
    #[ORM\JoinColumn(nullable: true)]
    private Article $article;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getVin(): string
    {
        return $this->vin;
    }

    /**
     * @param string $vin
     */
    public function setVin(string $vin): void
    {
        $this->vin = $vin;
    }

    /**
     * @return string
     */
    public function getVehicleBrand(): string
    {
        return $this->vehicleBrand;
    }

    /**
     * @param string $vehicleBrand
     */
    public function setVehicleBrand(string $vehicleBrand): void
    {
        $this->vehicleBrand = $vehicleBrand;
    }

    /**
     * @return string
     */
    public function getVehicleModel(): string
    {
        return $this->vehicleModel;
    }

    /**
     * @param string $vehicleModel
     */
    public function setVehicleModel(string $vehicleModel): void
    {
        $this->vehicleModel = $vehicleModel;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return date
     */
    public function getYearOfManufacture(): \DateTime
    {
        return $this->yearOfManufacture;
    }

    /**
     * @param date $yearOfManufacture
     */
    public function setYearOfManufacture(\DateTime $yearOfManufacture): void
    {
        $this->yearOfManufacture = $yearOfManufacture;
    }

    /**
     * @return string
     */
    public function getEngineModel(): string
    {
        return $this->engineModel;
    }

    /**
     * @param string $engineModel
     */
    public function setEngineModel(string $engineModel): void
    {
        $this->engineModel = $engineModel;
    }

    /**
     * @return string
     */
    public function getEngineNumber(): string
    {
        return $this->engineNumber;
    }

    /**
     * @param string $engineNumber
     */
    public function setEngineNumber(string $engineNumber): void
    {
        $this->engineNumber = $engineNumber;
    }

    /**
     * @return string
     */
    public function getChassisNumber(): string
    {
        return $this->chassisNumber;
    }

    /**
     * @param string $chassisNumber
     */
    public function setChassisNumber(string $chassisNumber): void
    {
        $this->chassisNumber = $chassisNumber;
    }

    /**
     * @return string
     */
    public function getBodyworkNumber(): string
    {
        return $this->bodyworkNumber;
    }

    /**
     * @param string $bodyworkNumber
     */
    public function setBodyworkNumber(string $bodyworkNumber): void
    {
        $this->bodyworkNumber = $bodyworkNumber;
    }

    /**
     * @return string
     */
    public function getVehicleColor(): string
    {
        return $this->vehicleColor;
    }

    /**
     * @param string $vehicleColor
     */
    public function setVehicleColor(string $vehicleColor): void
    {
        $this->vehicleColor = $vehicleColor;
    }

    /**
     * @return int
     */
    public function getEnginePower(): int
    {
        return $this->enginePower;
    }

    /**
     * @param int $enginePower
     */
    public function setEnginePower(int $enginePower): void
    {
        $this->enginePower = $enginePower;
    }

    /**
     * @return int
     */
    public function getEngineCapacity(): int
    {
        return $this->engineCapacity;
    }

    /**
     * @param int $engineCapacity
     */
    public function setEngineCapacity(int $engineCapacity): void
    {
        $this->engineCapacity = $engineCapacity;
    }

    /**
     * @return string
     */
    public function getEngineType(): string
    {
        return $this->engineType;
    }

    /**
     * @param string $engineType
     */
    public function setEngineType(string $engineType): void
    {
        $this->engineType = $engineType;
    }

    /**
     * @return int
     */
    public function getMass(): int
    {
        return $this->mass;
    }

    /**
     * @param int $mass
     */
    public function setMass(int $mass): void
    {
        $this->mass = $mass;
    }

    /**
     * @return string
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * @param string $manufacturer
     */
    public function setManufacturer(string $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }


    /**
     * @return datetime
     */
    public function getInDate(): \DateTime
    {
        return $this->inDate;
    }

    /**
     * @param datetime $inDate
     */
    public function setInDate(\DateTime $inDate): void
    {
        $this->inDate = $inDate;
    }

    /**
     * @return datetime
     */
    public function getOutDate(): \DateTime
    {
        return $this->outDate;
    }

    /**
     * @param datetime $outDate
     */
    public function setOutDate(\DateTime $outDate): void
    {
        $this->outDate = $outDate;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getContractItem(): ContractItem
    {
        return $this->contractItem;
    }

    public function setContractItem(ContractItem $contractItem): void
    {
        $this->contractItem = $contractItem;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function setArticle(Article $article): void
    {
        $this->article = $article;
    }

}
