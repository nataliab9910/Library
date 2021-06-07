<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RentalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "put", "delete"}
 * )
 * @ORM\Entity(repositoryClass=RentalRepository::class)
 */
class Rental
{
    const STATUS_ORDERED = 'zamówiona';
    const STATUS_WAITING = 'oczekuje na odbiór';
    const STATUS_RENTED = 'wypożyczona';
    const STATUS_RETURNED = 'zwrócona';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="rentals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reader;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $rentDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $expReturnDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $returnDate;

    /**
     * @ORM\ManyToOne(targetEntity=AffiliatesBooks::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $book;

    /**
     * @ORM\Column(type="string", length=255, options={"default":"ordered"})
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $order_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReader(): ?User
    {
        return $this->reader;
    }

    public function setReader(?User $reader): self
    {
        $this->reader = $reader;

        return $this;
    }

    public function getRentDate(): ?\DateTimeInterface
    {
        return $this->rentDate;
    }

    public function setRentDate(\DateTimeInterface $rentDate): self
    {
        $this->rentDate = $rentDate;

        return $this;
    }

    public function getExpReturnDate(): ?\DateTimeInterface
    {
        return $this->expReturnDate;
    }

    public function setExpReturnDate(\DateTimeInterface $expReturnDate): self
    {
        $this->expReturnDate = $expReturnDate;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->returnDate;
    }

    public function setReturnDate(?\DateTimeInterface $returnDate): self
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    public function getBook(): ?AffiliatesBooks
    {
        return $this->book;
    }

    public function setBook(?AffiliatesBooks $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->order_date;
    }

    public function setOrderDate(?\DateTimeInterface $order_date): self
    {
        $this->order_date = $order_date;

        return $this;
    }
}
