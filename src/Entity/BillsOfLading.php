<?php

namespace App\Entity;

use App\Repository\BillsOfLadingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BillsOfLadingRepository::class)]
class BillsOfLading
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer", options:["unsigned" => true, "comment" => "Идентификатор"])]
    private int $id;

    #[ORM\Column(type:"string", options:["comment" => "Грузополучатель"])]
    private string $recipient;

    #[ORM\Column(type:"string", options:["comment" => "ФИО покупателя"])]
    private string $buyer;

    #[ORM\Column(type:"string", options:["comment" => "ФИО продавца"])]
    private string $seller;

    #[ORM\Column(type:"bigint", options:["unsigned" => true, "comment" => "Номер договора"])]
    private bigint $contractId;

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
    public function getRecipient(): string
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     */
    public function setRecipient(string $recipient): void
    {
        $this->recipient = $recipient;
    }

    /**
     * @return string
     */
    public function getBuyer(): string
    {
        return $this->buyer;
    }

    /**
     * @param string $buyer
     */
    public function setBuyer(string $buyer): void
    {
        $this->buyer = $buyer;
    }

    /**
     * @return string
     */
    public function getSeller(): string
    {
        return $this->seller;
    }

    /**
     * @param string $seller
     */
    public function setSeller(string $seller): void
    {
        $this->seller = $seller;
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

}
