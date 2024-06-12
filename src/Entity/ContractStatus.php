<?php

namespace App\Entity;

use App\Repository\ContractStatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContractStatusRepository::class)]
class ContractStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer", options:["unsigned" => true, "comment" => "Идентификатор"])]
    private int $id;

    #[ORM\Column(type:"bigint", options:["unsigned" => true, "comment" => "Номер договора"])]
    private bigint $contractId;

    #[ORM\Column(type:"datetime", options:["comment" => "Дата смены статуса"])]
    private datetime $statusChange;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return bigint
     */
    public function getContractId(): bigint
    {
        return $this->contractId;
    }

    /**
     * @param bigint $contractId
     */
    public function setContractId(bigint $contractId): void
    {
        $this->contractId = $contractId;
    }

    /**
     * @return datetime
     */
    public function getStatusChange(): datetime
    {
        return $this->statusChange;
    }

    /**
     * @param datetime $statusChange
     */
    public function setStatusChange(datetime $statusChange): void
    {
        $this->statusChange = $statusChange;
    }
}
