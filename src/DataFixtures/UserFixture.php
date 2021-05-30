<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserDetails;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    const USER_DATA = [["Anna", "Kowalska", "123456789", "31-300 Kraków ul. Warszawska 24"],
        ["Jan", "Nowak", "987654321", "31-302 Kraków ul. Podgórska 2/135"],
        ["Janina", "Nowak", "689689689", "31-302 Kraków ul. Podgórska 2/135"]];

    const ADMIN = ["admin", "admin", "000000000", ""];

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::USER_DATA as $userData)
        {
            $userDetails = $this->makeUserDetails(...$userData);
            $user = $this->makeUser($userDetails);
            $manager->persist($userDetails);
            $manager->persist($user);
        }

        $adminDetails = $this->makeUserDetails(...self::ADMIN);
        $admin = $this->makeAdmin($adminDetails);
        $manager->persist($adminDetails);
        $manager->persist($admin);

        $manager->flush();
    }

    private function makeUserDetails($name, $surname, $phone, $address)
    {
        $userDetails = new UserDetails();
        $userDetails->setName($name);
        $userDetails->setSurname($surname);
        $userDetails->setPhone($phone);
        $userDetails->setAddress($address);
        return $userDetails;
    }

    private function makeUser(UserDetails $userDetails)
    {
        $user = new User();
        $email = $userDetails->getName() . '@' . $userDetails->getSurname() . '.com';
        $password = $userDetails->getName() . '1';
        $user->setEmail($email);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $password
        ));
        $user->setUserDetails($userDetails);
        return $user;
    }

    private function makeAdmin(UserDetails $userDetails)
    {
        $user = $this->makeUser($userDetails);
        $user->setRoles(["ROLE_ADMIN"]);
        return $user;
    }
}
