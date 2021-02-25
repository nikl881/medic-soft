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
        $timestamp = rand(strtotime("Jan 01 1960"), strtotime("Nov 01 2016"));
        $randomDate = date("d.m.Y", $timestamp);

//        $timestamp = rand( strtotime("Jan 01 2015"), strtotime("Nov 01 2016") );

        return [
            ['Jan', 'de Keijzer', new \DateTime(), "jandekeijzer@mail.com", 922354, 'Achmea', "06-7345667"],
            ['Jan', 'de Hoop',new \DateTime() , "jandehoop@mail.com", 922354, 'Achmea', "06-8345667"],
            ['Willem', 'Rijners', new \DateTime() , "willemrijners@mail.com", 322354, 'Zilverenkruis', "06-1345667"],
            ['Josh', 'Zwart', new \DateTime() , "joshzwart@mail.com", 122354, 'Agis', "06-1345667"],
            ['Martha', 'Peters', new \DateTime() , "marthapeters@mail.com", 462354, 'Mensis', "06-1345667"],

            ['Remy', 'Klaasen',new \DateTime() , "remyklaassen@mail.com", 922354, 'Achmea', "06-9345667"],
            ['Piet', 'fortuin', new \DateTime() , "pietfortuin@mail.com", 922354, 'Achmea', "06-4345667"],
            ['Maaike', 'Smit', new \DateTime() , "maaikesmit@mail.com", 322354, 'Zilverenkruis', "06-2145667"],
            ['Gabriella', 'de Bruin', new \DateTime() , "gabrielladebruin@mail.com", 122354, 'Agis', "06-4445667"],
            ['Mierella', 'Klaver', new \DateTime() , "mierellaklaver@mail.com", 462354, 'Mensis', "06-7745667"],

            ['Boudewijn', 'Klerkx', new \DateTime()  , "boudewijnklerkx@mail.com", 922354, 'Achmea', "06-9345667"],
            ['Raymond', 'Visser', new \DateTime()  , "raymondvisser@mail.com", 922354, 'Achmea', "06-4345667"],
            ['Marienna', 'Smitse', new \DateTime() , "mariennasmitse@mail.com", 322354, 'Zilverenkruis', "06-2145667"],
            ['Madelon', 'Goud', new \DateTime() , "madelongoud@mail.com", 122354, 'Agis', "06-4445667"],
            ['Fransica', 'Kraam', new \DateTime() , "fransicakraam@mail.com", 462354, 'Mensis', "06-7745667"],

            ['Jim', 'Bean', new \DateTime()  , "jimbeam@mail.com", 122354, 'Achmea', "06-9345667"],
            ['Roger', 'Federer', new \DateTime()  , "rogerfederer@mail.com", 222354, 'Achmea', "06-1345667"],
            ['Rafael', 'Nadal', new \DateTime() , "rafaelnadal@mail.com", 522354, 'Zilverenkruis', "06-9145667"],
            ['Willam', 'Tsjonga', new \DateTime() , "willamtsjonga@mail.com", 622354, 'Agis', "06-0445667"],
            ['Mitchel', 'Rombouts', new \DateTime() , "mitchelrombouts@mail.com", 762354, 'Mensis', "06-5745667"],
        ];
    }
}