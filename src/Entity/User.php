<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
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
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private string $id; //UUID

    private string $lastname;

    private string $firstname;

    #[ORM\Column(length: 180, unique: true)]
    private string $email;

    #[ORM\Column]
    private array $roles = [USER::USER]; //every user has at least ROLE_USER

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private string $password;

    //Constructor
    public function __construct(string $lastname, string $firstname, string $email, string $password)
    {
        $this->id = Uuid::V4_RANDOM;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->password = $password;
    }

    //Getters & Setters
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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
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
