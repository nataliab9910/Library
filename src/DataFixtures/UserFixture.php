<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserDetails;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $userDetails1 = $this->makeUserDetails("Anna", "Kowalska", "123456789", "31-300 Kraków ul. Warszawska 24");
        $manager->persist($userDetails1);
        $manager->persist($this->makeUser($userDetails1));
        $userDetails2 = $this->makeUserDetails("Jan", "Nowak", "987654321", "31-302 Kraków ul. Podgórska 2/135");
        $manager->persist($userDetails2);
        $manager->persist($this->makeUser($userDetails2));
        $userDetails3 = $this->makeUserDetails("Janina", "Nowak", "689689689", "31-302 Kraków ul. Podgórska 2/135");
        $manager->persist($userDetails3);
        $manager->persist($this->makeUser($userDetails3));

        $manager->flush();
    }

    private function makeUserDetails($name, $surname, $phone, $address) {
        $userDetails = new UserDetails();
        $userDetails->setName($name);
        $userDetails->setSurname($surname);
        $userDetails->setPhone($phone);
        $userDetails->setAddress($address);
        return $userDetails;
    }

    private function makeUser(UserDetails $userDetails) {
        $user = new User();
        $user->setEmail($userDetails->getName().'@'.$userDetails->getSurname().'.com');
        $user->setPassword($userDetails->getName().'1');
        $user->setUserDetails($userDetails);
        return $user;
    }
}
