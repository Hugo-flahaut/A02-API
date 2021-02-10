<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PlacesRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"places:read"}},
 *      denormalizationContext={"groups"={"places:write"}}
 * )
 * @ORM\Entity(repositoryClass=PlacesRepository::class)
 */
class Places
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"places:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"places:read", "places:write"})
     */
    private $placeNumber;

    /**
     * @ORM\ManyToOne(targetEntity=Rooms::class, inversedBy="places")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"places:read", "rooms:read"})
     */
    private $rooms;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"places:read", "places:write"})
     */
    private $isReserved;

    /**
     * @ORM\ManyToOne(targetEntity=Orders::class, inversedBy="places")
     * @Groups({"places:read", "orders:read"})
     */
    private $orders;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRooms(): ?Rooms
    {
        return $this->rooms;
    }

    public function setRooms(?Rooms $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getIsReserved(): ?bool
    {
        return $this->isReserved;
    }

    public function setIsReserved(bool $isReserved): self
    {
        $this->isReserved = $isReserved;

        return $this;
    }

    public function getPlaceNumber(): ?int
    {
        return $this->placeNumber;
    }

    public function setPlaceNumber(int $placeNumber): self
    {
        $this->placeNumber = $placeNumber;

        return $this;
    }

    public function getOrders(): ?Orders
    {
        return $this->orders;
    }

    public function setOrders(?Orders $orders): self
    {
        $this->orders = $orders;

        return $this;
    }
}
