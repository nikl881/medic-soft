<?php

namespace App\DataFixtures;

use App\Entity\Patient;
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

            ['Jan', 'de Hoop', (new \DateTime($randomDate)), "jandehoop@mail.com", 922354, 'Achmea', "06-1345667"],
            ['Willem', 'Rijners', (new \DateTime($randomDate)), "willemrijners@mail.com", 322354, 'Zilverenkruis', "06-1345667"],
            ['Josh', 'Zwart', (new \DateTime($randomDate)), "joshzwart@mail.com", 122354, 'Agis', "06-1345667"],
            ['Martha', 'Peters', (new \DateTime($randomDate)), "marthapeters@mail.com", 462354, 'Mensis', "06-1345667"],
        ];
    }
}