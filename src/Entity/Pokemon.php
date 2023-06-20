<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PokemonRepository::class)]
class Pokemon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    //#[ORM\GeneratedValue(strategy: "NONE")]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: "pas bien")]
    #[Assert\Length(
        min: 4,
        max: 50,
        minMessage: "Le nom doit avoir au moins 4 caractères",
        maxMessage: "Le nom doit avoir moins de 100 caractères")]
    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $catchDay = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $catchPlace = null;

    #[Assert\Type(
        type: 'integer', message: "saisir un nombre entier"
    )]
    #[Assert\Range(
        min: 1,
        max: 100,
        notInRangeMessage: "Numéro doit etre compris entre 1 et 100"
    )]
    #[ORM\Column]
    private ?int $level = null;


    #[Assert\Type(
        type: 'integer', message: "saisir un nombre entier"
    )]
    #[Assert\Range(
        min: 1,
        max: 500,
        notInRangeMessage: "Numéro doit etre compris entre 50 et 500"
    )]
    #[ORM\Column]
    private ?int $hp = null;

    #[ORM\Column]
    private ?bool $shiny = null;

    #[ORM\Column(nullable: true)]
    private ?int $daysDiff = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Pen $pen = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCatchDay(): ?\DateTimeInterface
    {
        return $this->catchDay;
    }

    public function setCatchDay(\DateTimeInterface $catchDay): static
    {
        $this->catchDay = $catchDay;

        return $this;
    }

    public function getCatchPlace(): ?string
    {
        return $this->catchPlace;
    }

    public function setCatchPlace(?string $catchPlace): static
    {
        $this->catchPlace = $catchPlace;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getHp(): ?int
    {
        return $this->hp;
    }

    public function setHp(int $hp): static
    {
        $this->hp = $hp;

        return $this;
    }

    public function isShiny(): ?bool
    {
        return $this->shiny;
    }

    public function setShiny(bool $shiny): static
    {
        $this->shiny = $shiny;

        return $this;
    }

    public function getDaysDiff(): ?int
    {
        return $this->daysDiff;
    }

    public function setDaysDiff(?int $daysDiff): static
    {
        $this->daysDiff = $daysDiff;

        return $this;
    }

    public function getPen(): ?Pen
    {
        return $this->pen;
    }

    public function setPen(?Pen $pen): static
    {
        $this->pen = $pen;

        return $this;
    }
}
