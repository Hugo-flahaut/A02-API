<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"orders:read"}},
 *      denormalizationContext={"groups"={"orders:write"}}
 * )
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"orders:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"orders:read", "orders:write", "places:read"})
     * @Assert\NotBlank
     * @Assert\Length(
     *   min = 4,
     *   max = 20,
     *   minMessage = "Votre prénom doit faire au moins {{ limit }} caractères",
     *   maxMessage = "Votre prénom ne doit pas faire plus de {{ limit }} caractères"
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"orders:read", "orders:write", "places:read"})
     * @Assert\NotBlank(
     *   message = "Ce champs ne peux pas être vide"
     * )
     * @Assert\Length(
     *   min = 4,
     *   max = 20,
     *   minMessage = "Votre nom doit faire au moins {{ limit }} caractères",
     *   maxMessage = "Votre nom ne doit pas faire plus de {{ limit }} caractères"
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"orders:write"})
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Places::class, mappedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"orders:read", "orders:write"})
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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
            $place->setOrders($this);
        }

        return $this;
    }

    public function removePlace(Places $place): self
    {
        if ($this->places->removeElement($place)) {
            // set the owning side to null (unless already changed)
            if ($place->getOrders() === $this) {
                $place->setOrders(null);
            }
        }

        return $this;
    }
}
