<?php

namespace App\DataFixtures;

use App\Entity\Places;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PlacesFixtures extends Fixture implements DependentFixtureInterface
{
   
    public function load(ObjectManager $manager)
    {

        $places = [
            "isReserved" => false
        ];

        for($i = 0; $i < 25; ++$i){
            $placeRoomOne = new Places();

            $placeRoomOne->setPlaceNumber($i);
            $placeRoomOne->setIsReserved($places['isReserved']);
            $placeRoomOne->setOrders(null);

            $placeRoomOne->setRooms($this->getReference(RoomsFixtures::ROOMS_ONE));

            $manager->persist($placeRoomOne);
        }

        for($e = 0; $e < 15; ++$e){
            $placeRoomTwo = new Places();

            $placeRoomTwo->setPlaceNumber($e);
            $placeRoomTwo->setIsReserved($places['isReserved']);
            $placeRoomTwo->setOrders(null);

            $placeRoomTwo->setRooms($this->getReference(RoomsFixtures::ROOMS_TWO));

            $manager->persist($placeRoomTwo);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            RoomsFixtures::class,
        );
    }
}
