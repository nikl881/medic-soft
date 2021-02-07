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
        $user = new User();
        $user->setName('Niels');
        $user->setLastName('de Klerk');
        $user->setLicenceNumber(214341);
        $user->setMedicalSpecialty('radiology');
        $user->setDateCreated(new \DateTime());
        $user->setEmail('test@mail.com');
        $user->setPassword($this->encoder->encodePassword($user,'password'));
        $manager->persist($user);

        $manager->flush();
    }
}