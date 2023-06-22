<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    //#[ORM\GeneratedValue(strategy: "NONE")]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Specie::class, inversedBy: 'types')]
    private Collection $species;




    public function __construct()
    {
        $this->pokemons = new ArrayCollection();
        $this->species = new ArrayCollection();

    }

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

    /**
     * @return Collection<int, Specie>
     */
    public function getSpecies(): Collection
    {
        return $this->species;
    }

    public function addSpecies(Specie $species): static
    {
        if (!$this->species->contains($species)) {
            $this->species->add($species);
        }

        return $this;
    }

    public function removeSpecies(Specie $species): static
    {
        $this->species->removeElement($species);

        return $this;
    }


}
