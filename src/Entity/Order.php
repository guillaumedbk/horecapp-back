<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
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

    //Constructor
    public function __construct(\DateTime $orderedAt, int $price)
    {
        $this->id = Uuid::v4();
        $this->orderedAt = $orderedAt;
        $this->price = $price;
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
}
