<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    //Roles const
    public const CLIENT = 'ROLE_CLIENT';
    public const PROFESSIONAL = 'ROLE_PROFESSIONAL';
    public const USER = 'ROLE_USER';
    public const ADMIN = 'ROLE_ADMIN';

    //Attributes
    #[ORM\Id]
    #[ORM\Column]
    private string $id; //UUID
    #[ORM\Column]
    private string $lastname;
    #[ORM\Column]
    private string $firstname;
    #[ORM\Column(length: 180, unique: true)]
    private string $email;
    #[ORM\Column]
    private array $roles = [USER::USER]; //every user has at least ROLE_USER
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Order::class, orphanRemoval: true)]
    private Collection $order;
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Restaurant::class, orphanRemoval: true)]
    private Collection $restaurant;
    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private string $password;

    //Constructor
    public function __construct(string $lastname, string $firstname, string $email, string $password)
    {
        $this->id = Uuid::v4();
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->password = $password;
        $this->order = new ArrayCollection();
        $this->restaurant = new ArrayCollection();
    }

    //Getters
    public function getId(): string
    {
        return $this->id;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return array_unique($this->roles);
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return iterable<Order>
     */
    public function getOrder(): iterable
    {
        return $this->order;
    }

    /**
     * @return iterable<Restaurant>
     */
    public function getRestaurant(): iterable
    {
        return $this->restaurant;
    }

    //Setters
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
    }
}
