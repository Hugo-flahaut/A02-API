<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlacesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PlacesRepository::class)
 */
class Places
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Rooms::class, inversedBy="places")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rooms;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isReserved;

    /**
     * @ORM\Column(type="integer")
     */
    private $place_number;

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
        return $this->place_number;
    }

    public function setPlaceNumber(int $place_number): self
    {
        $this->place_number = $place_number;

        return $this;
    }
}
