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
        foreach ($this->getUserData() as [$name, $lastName, $licence, $specialty, $email, $password, $roles])
        {
        $user = new User();

        $user->setName($name);
        $user->setLastName($lastName);
        $user->setLicenceNumber($licence);
        $user->setMedicalSpecialty($specialty);
        $user->setEmail($email);
        $user->setPassword($this->encoder->encodePassword($user, $password));
        $user->setRoles($roles);
        $user->setDateCreated(new \DateTime());
        $manager->persist($user);
        }
        $manager->flush();
    }

    private function getUserData(): array
    {
        return [
            ['Eric', 'de Koning', 1231414, 'Dermatoloy', 'koning@mail.loc', 'password', ['ROLE_ADMIN']],
            ['David', 'Dermers', 6633314, 'Radiology', 'dermers@mail.loc', 'password', ['ROLE_ADMIN']],
            ['Anna', 'de Graaf',9231419, 'Pathology', 'degraaf@mail.loc', 'password',['ROLE_ADMIN']],
            ['Henrieke', 'Willemse',7237414, 'Micro biology', 'willemse@mail.loc', 'password', ['ROLE_ADMIN']],

        ];
    }
}