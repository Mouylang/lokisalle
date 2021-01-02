<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Room;

class RoomFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0;$i <= 10;$i++){
            $room = new Room();
            $room->setCountry("France");
            $room->setCity('Paris');
            $room->setAddress('30 rue de la République');
            $room->setZipCode('75011');
            $room->setTitle("Salle no: $i");
            $room->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tincidunt eget nulla vel pellentesque. Nullam congue nibh id purus iaculis, id eleifend risus convallis. Etiam lacinia faucibus lacinia. Phasellus placerat erat vitae diam accumsan, a sollicitudin tortor ornare. Pellentesque at lorem justo. Morbi eget vulputate purus, sed sollicitudin nisi. Duis malesuada eget turpis nec pulvinar. Curabitur ornare condimentum porttitor.');
            $room->setPhoto("http://placehold.it/350x150");
            $room->setCapacity(20);
            $room->setCategory('1');

            $manager->persist($room);

        }
        

        $manager->flush();
    }
}
