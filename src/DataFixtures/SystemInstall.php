<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SystemInstall extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->createUsers($manager);
    }


    private function createUsers(ObjectManager $manager): void
    {
        foreach ($this->getUserData() as [$lastName, $firstName, $patronymicName,$is_active,  $login, $password, $email, $roles]) {
            $user = new User();
            $user->setLastName($lastName);
            $user->setFirstName($firstName);
            $user->setPatronymic($patronymicName);
            $user->setIsActive($is_active);
            $user->setLogin($login);
            $user->setPassword($password);
            $user->setEmail($email);
            $user->setRoles($roles);
            $manager->persist($user);
        }
        $manager->flush();
    }
    private function getUserData(): array
    {
        return [
            // $userData = [$lastName, $firstName, $patronymicName, $is_active, $login, $password, $email, $roles];
            ['Гайдай','Леонид','Йовович', true,'admin', '12345', 'admin@corp.ru', ['ROLE_ADMIN','ROLE_USER_STORE', 'ROLE_USER_SALE', 'ROLE_USER_FIN']],
            ['Вицын','Георгий','Михайлович', true,'user_store', '12345', 'user_store@corp.ru', ['ROLE_USER_STORE']],
            ['Никулин','Юрий','Владимирович', true,'user_sale', '12345', 'user_sale@corp.ru', ['ROLE_USER_SALE']],
            ['Моргунов','Евгений','Александрович', true,'user_fin', '12345', 'user_fin@corp.ru', ['ROLE_USER_FIN']],
        ];
    }
}
