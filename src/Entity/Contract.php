<?php

namespace App\Entity;

use App\Repository\ContractRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints\Date;

#[ORM\Entity(repositoryClass: ContractRepository::class)]
class Contract
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer", options:["unsigned" => true, "comment" => "Идентификатор"])]
    private int $id;

    #[ORM\Column(type:"integer", options:["unsigned" => true, "comment" => "Номер договора"])]
    private int $contractNumber;

    #[ORM\Column(type:"string", nullable: true,options:["comment" => "Статус договора"])]
    private string $status;

    #[ORM\Column(type:"date", options:["comment" => "Дата подписания договора"])]
    private $contractDate;

    #[ORM\ManyToOne(targetEntity: Legal::class, inversedBy: 'contract')]
    private ?Legal $buyer=null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'contract')]
    private ?User $contragent=null;

    #[ORM\Column(type:"float", options:["unsigned" => true, "comment" => "Сумма к оплате по договору"])]
    private float $amount;

    #[ORM\Column(type:"float", options:["unsigned" => true, "comment" => "Сумма оплаченная по договору"])]
    private float $paid;

    #[ORM\OneToMany(targetEntity: ContractItem::class, mappedBy: 'contract', cascade: ['persist', 'remove'])]
    private Collection $contractItems;


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
     * @return int
     */
    public function getContractNumber(): int
    {
        return $this->contractNumber;
    }

    /**
     * @param int $contractNumber
     */
    public function setContractNumber(int $contractNumber): void
    {
        $this->contractNumber = $contractNumber;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getContractDate()
    {
        return $this->contractDate;
    }

    /**
     * @param mixed $contractDate
     */
    public function setContractDate($contractDate): void
    {
        $this->contractDate = $contractDate;
    }

    /**
     * @return int
     */
    public function getContragent(): ?User
    {
        return $this->contragent;
    }

    /**
     * @param int $contragent
     */
    public function setContragent(User $contragent): void
    {
        $this->contragent = $contragent;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    public function getBuyer(): ?Legal
    {
        return $this->buyer;
    }

    public function setBuyer(?Legal $buyer): void
    {
        $this->buyer = $buyer;
    }

    public function getContractItems(): Collection
    {
        return $this->contractItems;
    }

    public function setContractItems(mixed $contractItems): void
    {
        $this->contractItems = $contractItems;
    }

    public function getPaid(): float
    {
        return $this->paid;
    }

    public function setPaid(float $paid): void
    {
        $this->paid = $paid;
    }


}
