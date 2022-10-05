<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ApiResource]
#[ORM\Table(name: '`order`')]
class Order
{
    //Attributes
    #[ORM\Id]
    #[ORM\Column]
    private string $id; //UUID
    #[ORM\Column]
    private \DateTime $orderedAt;
    #[ORM\Column]
    private int $price;
    #[ORM\ManyToOne(inversedBy: 'order')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;
    #[ORM\ManyToOne(inversedBy: 'order')]
    #[ORM\JoinColumn(nullable: false)]
    private Restaurant $restaurant;
    #[ORM\OneToMany(mappedBy: 'order', targetEntity: Dish::class, orphanRemoval: true)]
    private Collection $dish;

    //Constructor
    public function __construct(\DateTime $orderedAt, int $price, User $user, Restaurant $restaurant)
    {
        $this->id = Uuid::v4();
        $this->orderedAt = $orderedAt;
        $this->price = $price;
        $this->user = $user;
        $this->restaurant = $restaurant;
        $this->dish = new ArrayCollection();
    }

    //Getters
    public function getId(): UuidV4|string
    {
        return $this->id;
    }

    public function getOrderedAt(): \DateTime
    {
        return $this->orderedAt;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getRestaurant(): Restaurant
    {
        return $this->restaurant;
    }

    /**
     * @return iterable<Dish>
     */
    public function getDish(): iterable
    {
        return $this->dish;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
