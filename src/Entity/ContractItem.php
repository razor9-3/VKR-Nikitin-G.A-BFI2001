<?php

namespace App\Entity;

use App\Repository\ContractItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContractItemRepository::class)]
class ContractItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer", options:["unsigned" => true, "comment" => "Идентификатор"])]
    private int $id;


    //#[ORM\ManyToOne(targetEntity: Contract::class, inversedBy: 'contractItems')]
    //private Contract $contract;

    #[ORM\ManyToOne(targetEntity: Contract::class, inversedBy: 'contractItems')]
    #[ORM\JoinColumn(nullable: false)]
    private Contract $contract;

//    #[ORM\OneToOne(targetEntity: Vehicle::class, mappedBy: "contractItem", cascade: ["persist", "remove"])]
    #[ORM\ManyToOne(targetEntity: Vehicle::class, inversedBy: 'contractItem')]
    #[ORM\JoinColumn(nullable: true)]
    private Vehicle $vehicle;

    public function getVehicle(): Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(Vehicle $vehicle): void
    {
        $this->vehicle = $vehicle;
    }

    public function getContract(): Contract
    {
        return $this->contract;
    }

    public function setContract(Contract $contract): void
    {
        $this->contract = $contract;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

}
