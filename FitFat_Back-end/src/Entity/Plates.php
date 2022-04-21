<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlatesRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PlatesRepository::class)
 * @ApiFilter(SearchFilter::class, properties={
 *     "description": "partial",
 *     "nom": "partial",
 *     "prix": "partial"
 *
 * })
 * @ApiFilter(
 *    OrderFilter::class, properties={"id" : "asc"})
 *
 */
class Plates
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="plates")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Restaurant;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->Restaurant;
    }

    public function setRestaurant(?Restaurant $Restaurant): self
    {
        $this->Restaurant = $Restaurant;

        return $this;
    }
}
