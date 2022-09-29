<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class RestaurantDTO
{
    //Attributes
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $name;

    #[Assert\Choice(['GASTRONOMIC', 'ITALIAN'])]
    #[Assert\Type('string')]
    private string $type;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $address;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $city;

    #[Assert\NotBlank]
    #[Assert\Type(
        type: 'integer',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    private int $postalCode;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $country;

    #[Assert\NotBlank]
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    private string $email;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $password;

    #[Assert\NotBlank]
    #[Assert\Type(
        type: 'string',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    private string $tvaNumber;
}