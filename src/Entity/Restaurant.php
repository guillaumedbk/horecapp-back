<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV4;

#[ORM\Entity(repositoryClass: RestaurantRepository::class)]
#[ApiResource]
#[ORM\Table(name: '`restaurant`')]
class Restaurant
{
    //Attributes
    #[ORM\Id]
    #[ORM\Column]
    private Uuid $id; //UUID
    #[ORM\Column (name: "name", type: "string", unique: true)]
    private string $name;
    #[ORM\Column (name: "type", type: "string", columnDefinition: "enum('GASTRONOMIC', 'ITALIAN')")]
    private string $type;
    #[ORM\Column (name: "address", type: "string")]
    private string $address;
    #[ORM\Column (name: "city", type: "string")]
    private string $city;
    #[ORM\Column (name: "postalCode", type: "integer")]
    private int $postalCode;
    #[ORM\Column (name: "country", type: "string")]
    private string $country;
    #[ORM\Column (name: "email", type: "string")]
    private string $email;
    #[ORM\Column (name: "password", type: "string")]
    private string $password;
    #[ORM\Column (name: "tvaNumber", type: "string")]
    private string $tvaNumber;
    #[ORM\ManyToOne(inversedBy: 'restaurant')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;
    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Order::class, orphanRemoval: true)]
    private Collection $order;
    #[ORM\OneToMany(mappedBy: 'restaurant', targetEntity: Dish::class, orphanRemoval: true)]
    private Collection $dish;

    //Constructor
    public function __construct(string $name, string $type, string $address, string $city, int $postalCode, string $country, string $email, string $password, string $tvaNumber, User $user)
    {
        $this->id = Uuid::v4();
        $this->name = $name;
        $this->type = $type;
        $this->address = $address;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->country = $country;
        $this->email = $email;
        $this->password = $password;
        $this->tvaNumber = $tvaNumber;
        $this->user = $user;
        $this->order = new ArrayCollection();
        $this->dish = new ArrayCollection();
    }

    //Getters
    public function getId(): UuidV4|Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPostalCode(): int
    {
        return $this->postalCode;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getTvaNumber(): string
    {
        return $this->tvaNumber;
    }

    /**
     * @return iterable<Order>
     */
    public function getOrder(): iterable
    {
        return $this->order;
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

    //Setters
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function setPostalCode(int $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param ArrayCollection|Collection $order
     */
    public function setOrder(ArrayCollection|Collection $order): void
    {
        $this->order = $order;
    }
}
