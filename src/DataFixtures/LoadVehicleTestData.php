<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Vehicle;
use DateTime;

class  LoadVehicleTestData extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $vehicles = [
            [
                'vin' => '1HGCM82633A004352',
                'vehicleBrand' => 'Tesla',
                'vehicleModel' => 'Model S',
                'type' => 'Sedan',
                'category' => 'Electric',
                'yearOfManufacture' => new DateTime('2022-01-01'),
                'engineModel' => 'Dual Motor',
                'engineNumber' => '123456789',
                'chassisNumber' => '1HGCM82633A004352',
                'bodyworkNumber' => '1HGCM82633A004352',
                'vehicleColor' => 'Red',
                'enginePower' => 1020,
                'engineCapacity' => 0,
                'engineType' => 'Electric',
                'mass' => 2200,
                'manufacturer' => 'Tesla Inc.',
                'articleId' => 1,
                'inDate' => new DateTime('2023-01-01'),
                'outDate' => new DateTime('2023-06-01'),
                'status' => 1,
            ],

            [
                'vin' => '1FA6P8TH0L5144289',
                'vehicleBrand' => 'Ford',
                'vehicleModel' => 'Mustang',
                'type' => 'Coupe',
                'category' => 'Sport',
                'yearOfManufacture' => new DateTime('2023-01-01'),
                'engineModel' => 'EcoBoost',
                'engineNumber' => '987654321',
                'chassisNumber' => '1FA6P8TH0L5144289',
                'bodyworkNumber' => '1FA6P8TH0L5144289',
                'vehicleColor' => 'Blue',
                'enginePower' => 450,
                'engineCapacity' => 2300,
                'engineType' => 'Petrol',
                'mass' => 1650,
                'manufacturer' => 'Ford Motor Company',
                'articleId' => 10,
                'inDate' => new DateTime('2023-02-01'),
                'outDate' => new DateTime('2023-07-01'),
                'status' => 1,
            ],

            [
                'vin' => 'WAUAH74F76N002141',
                'vehicleBrand' => 'Audi',
                'vehicleModel' => 'A4',
                'type' => 'Sedan',
                'category' => 'Luxury',
                'yearOfManufacture' => new DateTime('2023-01-01'),
                'engineModel' => 'TFSI',
                'engineNumber' => '345678912',
                'chassisNumber' => 'WAUAH74F76N002141',
                'bodyworkNumber' => 'WAUAH74F76N002141',
                'vehicleColor' => 'Black',
                'enginePower' => 250,
                'engineCapacity' => 2000,
                'engineType' => 'Petrol',
                'mass' => 1600,
                'manufacturer' => 'Audi AG',
                'articleId' => 11,
                'inDate' => new DateTime('2023-03-01'),
                'outDate' => new DateTime('2023-08-01'),
                'status' => 1,
            ],

            [
                'vin' => 'JM1BL1K35C1578201',
                'vehicleBrand' => 'Mazda',
                'vehicleModel' => 'MX-5',
                'type' => 'Convertible',
                'category' => 'Sport',
                'yearOfManufacture' => new DateTime('2023-01-01'),
                'engineModel' => 'SKYACTIV-G',
                'engineNumber' => '246810975',
                'chassisNumber' => 'JM1BL1K35C1578201',
                'bodyworkNumber' => 'JM1BL1K35C1578201',
                'vehicleColor' => 'White',
                'enginePower' => 181,
                'engineCapacity' => 2000,
                'engineType' => 'Petrol',
                'mass' => 1050,
                'manufacturer' => 'Mazda Motor Corporation',
                'articleId' => 20,
                'inDate' => new DateTime('2023-04-01'),
                'outDate' => new DateTime('2023-09-01'),
                'status' => 1,
            ],
        ];

        foreach ($vehicles as $vehicleData) {
            $vehicle = new Vehicle();
            $vehicle->setVin($vehicleData['vin']);
            $vehicle->setVehicleBrand($vehicleData['vehicleBrand']);
            $vehicle->setVehicleModel($vehicleData['vehicleModel']);
            $vehicle->setType($vehicleData['type']);
            $vehicle->setCategory($vehicleData['category']);
            $vehicle->setYearOfManufacture($vehicleData['yearOfManufacture']);
            $vehicle->setEngineModel($vehicleData['engineModel']);
            $vehicle->setEngineNumber($vehicleData['engineNumber']);
            $vehicle->setChassisNumber($vehicleData['chassisNumber']);
            $vehicle->setBodyworkNumber($vehicleData['bodyworkNumber']);
            $vehicle->setVehicleColor($vehicleData['vehicleColor']);
            $vehicle->setEnginePower($vehicleData['enginePower']);
            $vehicle->setEngineCapacity($vehicleData['engineCapacity']);
            $vehicle->setEngineType($vehicleData['engineType']);
            $vehicle->setMass($vehicleData['mass']);
            $vehicle->setManufacturer($vehicleData['manufacturer']);
            $vehicle->setInDate($vehicleData['inDate']);
            $vehicle->setOutDate($vehicleData['outDate']);
            $vehicle->setStatus($vehicleData['status']);

            $manager->persist($vehicle);
        }

        $manager->flush();
    }
}