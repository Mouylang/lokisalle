<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Room;
use Faker\Factory;

class RoomFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker=Factory::create('fr_FR');

        $faker2=Factory::create();

        $category1 =new Category();
        $category1->setName("Réunion");
        $manager->persist($category1);

        $category2 =new Category();
        $category2->setName("Conférence");
        $manager->persist($category2);

        for($i=1;$i <= 10;$i++){
            $room = new Room();
            $room->setCountry('France');
            $room->setCity($faker->city);
            $room->setAddress($faker->streetAddress);
            $room->setZipCode($faker->randomNumber(5,true));
            $room->setTitle("Salle " . $faker2->city);
            $room->setDescription($faker->text(500));
            $room->setPhoto("http://placehold.it/350x150");
            $room->setCapacity($faker->randomNumber(3));
            $room->setCategory($i%2==0?$category1:$category2);

            $manager->persist($room);

            for($j=0;$j < mt_rand(2,10); $j++){
                $comment=new Comment();
                $comment->setAuthor($faker->name());
                $comment->setContent($faker->text(200));
                $comment->setCreatedAt($faker->dateTimeBetween('-5 years'));
                $comment->setScore($faker->numberBetween(0,5));
                $comment->setRoom($room);

                $manager->persist($comment);
            }


        }
        

        $manager->flush();
    }
}
