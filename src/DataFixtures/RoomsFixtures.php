<?php

namespace App\DataFixtures;

use App\Entity\Rooms;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RoomsFixtures extends Fixture
{
    public const ROOMS_ONE = 'room-one';
    public const ROOMS_TWO = 'room-two';
    
    public function load(ObjectManager $manager)
    {
        $rooms = [
            [
                "name" => "Voie Lactée",
                // "" => ""
            ],
            [
                "name" => "Orion",
                // "" => ""
            ]
            
        ];

        for($i = 0; $i < 1; ++$i){
            $room = new Rooms();

            $room->setName('Voie Lactée');
            // $room->addPlaces($rooms[$i]['places']);

            $manager->persist($room); 
            $this->setReference(self::ROOMS_ONE, $room);
        }

        for($e = 0; $e < 1; ++$e){
            $room = new Rooms();

            $room->setName('Orion');
            // $room->addPlaces($rooms[$i]['places']);

            $manager->persist($room); 
            $this->setReference(self::ROOMS_TWO, $room);
        }

        $manager->flush();

    }
}
