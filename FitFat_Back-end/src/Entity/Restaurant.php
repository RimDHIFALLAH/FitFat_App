<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;


/**
 * @ApiResource(
 *     normalizationContext={"groups"={"restaurant:read"}},
 *     denormalizationContext={"groups"={"restaurant:write"}})
 * @ApiFilter(SearchFilter::class, properties={
 *     "adresse": "partial",
 *     "nom": "partial"
 * })
 * @ApiFilter(
 *    OrderFilter::class, properties={"id" : "asc"})
 *
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("restaurant:read")

     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"restaurant:read", "restaurant:write"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"restaurant:read", "restaurant:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"restaurant:read", "restaurant:write"})
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"restaurant:read", "restaurant:write"})
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"restaurant:read", "restaurant:write"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Plates::class, mappedBy="Restaurant", orphanRemoval=true )
     * @Groups({"restaurant:read", "restaurant:write"})
     */
    private $plates;

    public function __construct()
    {
        $this->plates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Plates[]
     */
    public function getPlates(): Collection
    {
        return $this->plates;
    }

    public function addPlate(Plates $plate): self
    {
        if (!$this->plates->contains($plate)) {
            $this->plates[] = $plate;
            $plate->setRestaurant($this);
        }

        return $this;
    }

    public function removePlate(Plates $plate): self
    {
        if ($this->plates->removeElement($plate)) {
            // set the owning side to null (unless already changed)
            if ($plate->getRestaurant() === $this) {
                $plate->setRestaurant(null);
            }
        }

        return $this;
    }
}