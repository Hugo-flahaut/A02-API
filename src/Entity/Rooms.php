<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\RoomsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *  normalizationContext={"groups"={"rooms:read"}},
 *  denormalizationContext={"groups"={"rooms:write"}}
 * )
 * @ORM\Entity(repositoryClass=RoomsRepository::class)
 */
class Rooms
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"rooms:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Groups({"rooms:read", "rooms:write", "places:read"})
     * @Assert\NotBlank (message = "Ce champs ne peut être vide")
     * @Assert\Length(
     *   min = 4,
     *   max = 20,
     *   minMessage = "Votre prénom doit faire au moins {{ limit }} caractères",
     *   maxMessage = "Votre prénom ne doit pas faire plus de {{ limit }} caractères"
     * )
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Places::class, mappedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"rooms:read", "rooms:write"})
     */
    private $places;

    public function __construct()
    {
        $this->places = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Places[]
     */
    public function getPlaces(): Collection
    {
        return $this->places;
    }

    public function addPlace(Places $place): self
    {
        if (!$this->places->contains($place)) {
            $this->places[] = $place;
            $place->setRooms($this);
        }

        return $this;
    }

    public function removePlace(Places $place): self
    {
        if ($this->places->removeElement($place)) {
            // set the owning side to null (unless already changed)
            if ($place->getRooms() === $this) {
                $place->setRooms(null);
            }
        }

        return $this;
    }

}
