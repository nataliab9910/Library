<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AffiliatesBooksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "put"}
 *     )
 * @ORM\Entity(repositoryClass=AffiliatesBooksRepository::class)
 */
class AffiliatesBooks
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Affiliate::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $affiliate;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="affiliates")
     * @ORM\JoinColumn(nullable=false)
     */
    private $book;

    /**
     * @ORM\Column(type="integer", options={"default":1})
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer", options={"default":1})
     */
    private $availableQuantity;

    /**
     * @ORM\Column(type="integer", options={"default":0})
     */
    private $orders;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAffiliate(): ?Affiliate
    {
        return $this->affiliate;
    }

    public function setAffiliate(?Affiliate $affiliate): self
    {
        $this->affiliate = $affiliate;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAvailableQuantity(): ?int
    {
        return $this->availableQuantity;
    }

    public function setAvailableQuantity(int $availableQuantity): self
    {
        $this->availableQuantity = $availableQuantity;

        return $this;
    }

    public function getOrders(): ?int
    {
        return $this->orders;
    }

    public function setOrders(int $orders): self
    {
        $this->orders = $orders;

        return $this;
    }
}
