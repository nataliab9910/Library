<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RentalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=RentalRepository::class)
 */
class Rental
{
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
     * @ORM\ManyToOne(targetEntity=Book::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $book;

    /**
     * @ORM\Column(type="datetime")
     */
    private $rentDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expReturnDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $returnDate;

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

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

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
}
