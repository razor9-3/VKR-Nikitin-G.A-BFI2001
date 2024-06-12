<?php

namespace App\Entity;

use App\Repository\PaymentOrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentOrderRepository::class)]
class PaymentOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer", options:["unsigned" => true, "comment" => "Идентификатор"])]
    private int $id;

    #[ORM\Column(type:"string", options:["comment" => "ФИО покупателя"])]
    private string $buyer;

    #[ORM\Column(type:"string", options:["comment" => "Банк покупателя"])]
    private string $buyerBank;

    #[ORM\Column(type:"string", options:["comment" => "ФИО продавца"])]
    private string $seller;

    #[ORM\Column(type:"string", options:["comment" => "Банк продавца"])]
    private string $sellerBank;

    #[ORM\Column(type:"float", options:["unsigned" => true, "comment" => "Сумма требуемая от покупателя"])]
    private float $summ;

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
    public function getBuyerBank(): string
    {
        return $this->buyerBank;
    }

    /**
     * @param string $buyerBank
     */
    public function setBuyerBank(string $buyerBank): void
    {
        $this->buyerBank = $buyerBank;
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
     * @return string
     */
    public function getSellerBank(): string
    {
        return $this->sellerBank;
    }

    /**
     * @param string $sellerBank
     */
    public function setSellerBank(string $sellerBank): void
    {
        $this->sellerBank = $sellerBank;
    }

    /**
     * @return float
     */
    public function getSumm(): float
    {
        return $this->summ;
    }

    /**
     * @param float $summ
     */
    public function setSumm(float $summ): void
    {
        $this->summ = $summ;
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
