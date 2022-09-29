<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DishRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DishRepository::class)]
#[ApiResource]
#[ORM\Table(name: '`dish`')]
class Dish
{
    //Attributes
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(name: "name")]
    private string $name;
    #[ORM\Column(name: "price")]
    private int $price;
    #[ORM\Column(name: "category", type: "string", columnDefinition: "enum('APPETIZER', 'MAIN', 'DESERT', 'VEGE', 'VEGAN')")]
    private string $category;
    #[ORM\Column(name: "reference", unique: true)]
    private string $reference;

    //Constructor
    public function __construct(string $name, int $price, string $category, string $reference)
    {
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
        $this->reference = $reference;
    }

    //Getters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    //Setters
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }
}
