<?php

namespace App\DataFixtures;

use App\Entity\Patient;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class PatientFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        foreach ($this->getPatientData() as [$name, $lastName, $birthdate, $email, $insuranceNumber, $insuranceCompany, $phoneNumber]) {
            $patient = new Patient();

            $patient->setName($name);
            $patient->setLastName($lastName);
            $patient->setBirthdate($birthdate);
            $patient->setEmail($email);
            $patient->setinsuranceNumber($insuranceNumber);
            $patient->setinsuranceCompany($insuranceCompany);
            $patient->setPhoneNumber((string)$phoneNumber);
            $patient->setDateCreated(new \DateTime());
            $manager->persist($patient);
        }
        $manager->flush();
    }

    private function getPatientData(): array
    {
        $timestamp = rand(strtotime("Jan 01 1950"), strtotime("Nov 01 2016"));
        $randomDate = date("d.m.Y", $timestamp);

        return [
            ['Jan', 'de Hoop', date("Y-m-d H:i:s", (rand())) , "jandehoop@mail.com", 922354, 'Achmea', "06-1345667"],
            ['Jan', 'de Hoop', date("Y-m-d H:i:s", (rand())) , "jandehoop@mail.com", 922354, 'Achmea', "06-1345667"],
            ['Willem', 'Rijners', date("Y-m-d H:i:s", (rand())), "willemrijners@mail.com", 322354, 'Zilverenkruis', "06-1345667"],
            ['Josh', 'Zwart', date("Y-m-d H:i:s", (rand())), "joshzwart@mail.com", 122354, 'Agis', "06-1345667"],
            ['Martha', 'Peters', date("Y-m-d H:i:s", (rand())), "marthapeters@mail.com", 462354, 'Mensis', "06-1345667"],
        ];
    }
}