<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BrandRepository::class)
 */
class Brand
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
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marqueUrl;

    /**
     * @ORM\OneToMany(targetEntity=Sneakers::class, mappedBy="brand")
     */
    private $sneakers;

    public function __construct()
    {
        $this->sneakers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getMarqueUrl(): ?string
    {
        return $this->marqueUrl;
    }

    public function setMarqueUrl(string $marqueUrl): self
    {
        $this->marqueUrl = $marqueUrl;

        return $this;
    }

    /**
     * @return Collection|Sneakers[]
     */
    public function getSneakers(): Collection
    {
        return $this->sneakers;
    }

    public function addSneaker(Sneakers $sneaker): self
    {
        if (!$this->sneakers->contains($sneaker)) {
            $this->sneakers[] = $sneaker;
            $sneaker->setBrand($this);
        }

        return $this;
    }

    public function removeSneaker(Sneakers $sneaker): self
    {
        if ($this->sneakers->removeElement($sneaker)) {
            // set the owning side to null (unless already changed)
            if ($sneaker->getBrand() === $this) {
                $sneaker->setBrand(null);
            }
        }

        return $this;
    }
}
