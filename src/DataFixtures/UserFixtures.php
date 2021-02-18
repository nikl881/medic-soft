<?php


namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    protected function dateCreated()
    {
        $dateTime = $this->dateCreated = new DateTime();

    }

    public function load(ObjectManager $manager)
    {
        foreach ($this->getUserData() as [$name, $lastName, $licence, $specialty, $email, $phoneNumber, $password, $working, $location, $roles ])
        {
        $user = new User();

        $user->setName($name);
        $user->setLastName($lastName);
        $user->setLicenceNumber($licence);
        $user->setMedicalSpecialty($specialty);
        $user->setEmail($email);
        $user->setPhoneNumber($phoneNumber);
        $user->setPassword($this->encoder->encodePassword($user, $password));
        $user->setWorking($working);
        $user->setLocation($location);
        $user->setRoles($roles);
        $user->setDateCreated(new \DateTime());
        $manager->persist($user);
        }
        $manager->flush();
    }

    private function getUserData(): array
    {
        return [
            ['Eric', 'de Koning', 1231414, 'Dermatoloy', 'koning@mail.loc', '0612343221', 'password', true, 'B1',['ROLE_ADMIN']],
            ['David', 'Dermers', 6633314, 'Radiology', 'dermers@mail.loc', '0612343221','password', false, 'B1',['ROLE_ADMIN']],
            ['Anna', 'de Graaf',9231419, 'Pathology', 'degraaf@mail.loc', '0612343221','password', true,'B1',['ROLE_ADMIN']],
            ['Henrieke', 'Willemse',7237414, 'Micro biology', 'willemse@mail.loc','0612343221', 'password', false, 'B1',['ROLE_ADMIN']],

            ['Rosha', 'Shojaeian', 3236414, 'Dentists', 'shojaeian@mail.loc','0612343221', 'password', true,'B1',['ROLE_ADMIN']],
            ['Peter', 'Stone', 9933314, 'Radiology', 'stone@mail.loc','0612343221', 'password', true,'B1',['ROLE_ADMIN']],
            ['Robin', 'Schilling',9231419, 'Pathology', 'schilling@mail.loc', '0612343221','password', true,'B1',['ROLE_ADMIN']],
            ['Bob', 'de Bruin',7237414, 'Micro biology', 'bruin@mail.loc', '0612343221','password', true,'B1',['ROLE_ADMIN']],

            ['Wilfred', 'Keijzer', 1331414, 'Dermatoloy', 'keijzer@mail.loc', '0612343221','password', false,'B1',['ROLE_ADMIN']],
            ['Sophie', 'van Schaaik', 5633314, 'Radiology', 'schaaik@mail.loc', '0612343221','password',  true, 'B1',['ROLE_ADMIN']],
            ['Brunno', 'Waals',9231479, 'Pathology', 'waals@mail.loc','0612343221', 'password', false, 'B1',['ROLE_ADMIN']],
            ['Hannah', 'Willbert',7277414, 'Micro biology', 'willbert@mail.loc', '0612343221','password', true, 'B1',['ROLE_ADMIN']],

            ['Hubbert', 'le Marc', 1231414, 'Dermatoloy', 'lemarc@mail.loc','0612343221', 'password',  true, 'B1',['ROLE_ADMIN']],
            ['David', 'Smuel', 6633319, 'Radiology', 'smuel@mail.loc', '0612343221','password', true, 'B1',['ROLE_ADMIN']],
            ['Tim', 'Wester',9231411, 'Pathology', 'wester@mail.loc', '0612343221','password', false, 'B1',['ROLE_ADMIN']],
            ['Gregory', 'House',7207414, 'General medicine', 'house@mail.loc','0612343221', 'password', true, 'B1',['ROLE_ADMIN']],

        ];
    }
}