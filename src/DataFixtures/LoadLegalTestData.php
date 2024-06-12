<?php

namespace App\DataFixtures;

use App\Entity\Legal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadLegalTestData extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $entities = [
            [
                'name' => 'ООО Тестовая Организация 1',
                'inn' => '123456789012',
                'ogrn' => '1023456789012',
                'kpp' => '123456789',
                'address' => 'г. Москва, ул. Тестовая, д. 1',
                'phone' => '+7 495 123-45-67',
                'email' => 'test1@example.com',
                'registrationDate' => new \DateTime('2001-01-01'),
                'ownershipForm' => 'ООО',
                'director' => 'Иванов Иван Иванович',
                'accountant' => 'Петров Петр Петрович'
            ],
            [
                'name' => 'АО Тестовая Организация 2',
                'inn' => '223456789012',
                'ogrn' => '2023456789012',
                'kpp' => '223456789',
                'address' => 'г. Санкт-Петербург, ул. Тестовая, д. 2',
                'phone' => '+7 812 123-45-67',
                'email' => 'test2@example.com',
                'registrationDate' => new \DateTime('2002-02-02'),
                'ownershipForm' => 'АО',
                'director' => 'Сидоров Сидор Сидорович',
                'accountant' => 'Смирнов Смирн Смирнович'
            ],
            [
                'name' => 'ООО Тестовая Организация 3',
                'inn' => '323456789012',
                'ogrn' => '3023456789012',
                'kpp' => '323456789',
                'address' => 'г. Екатеринбург, ул. Тестовая, д. 3',
                'phone' => '+7 343 123-45-67',
                'email' => 'test3@example.com',
                'registrationDate' => new \DateTime('2003-03-03'),
                'ownershipForm' => 'ООО',
                'director' => 'Кузнецов Кузьма Кузьмич',
                'accountant' => 'Новиков Николай Николаевич'
            ],
            [
                'name' => 'АО Тестовая Организация 4',
                'inn' => '423456789012',
                'ogrn' => '4023456789012',
                'kpp' => '423456789',
                'address' => 'г. Новосибирск, ул. Тестовая, д. 4',
                'phone' => '+7 383 123-45-67',
                'email' => 'test4@example.com',
                'registrationDate' => new \DateTime('2004-04-04'),
                'ownershipForm' => 'АО',
                'director' => 'Федоров Федор Федорович',
                'accountant' => 'Морозов Михаил Михайлович'
            ],
        ];

        foreach ($entities as $data) {
            $entity = new Legal();
            $entity->setName($data['name']);
            $entity->setInn($data['inn']);
            $entity->setOgrn($data['ogrn']);
            $entity->setKpp($data['kpp']);
            $entity->setAddress($data['address']);
            $entity->setPhone($data['phone']);
            $entity->setEmail($data['email']);
            $entity->setRegistrationDate($data['registrationDate']);
            $entity->setOwnershipForm($data['ownershipForm']);
            $entity->setDirector($data['director']);
            $entity->setAccountant($data['accountant']);

            $manager->persist($entity);
        }

        $manager->flush();
    }
}