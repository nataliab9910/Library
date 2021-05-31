<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AffiliateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=AffiliateRepository::class)
 */
class Affiliate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $webpage;

    /**
     * @ORM\OneToMany(targetEntity=AffiliatesBooks::class, mappedBy="affiliate", orphanRemoval=true)
     */
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getWebpage(): ?string
    {
        return $this->webpage;
    }

    public function setWebpage(?string $webpage): self
    {
        $this->webpage = $webpage;

        return $this;
    }

    /**
     * @return Collection|AffiliatesBooks[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(AffiliatesBooks $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setAffiliate($this);
        }

        return $this;
    }

    public function removeBook(AffiliatesBooks $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getAffiliate() === $this) {
                $book->setAffiliate(null);
            }
        }

        return $this;
    }
}
