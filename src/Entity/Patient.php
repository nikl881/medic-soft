<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatientRepository::class)
 */
class Patient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $insuranceNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $insuranceCompany;


    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $primaryDoctorId;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="user_id")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?User $user;

    /**
     * @ORM\OneToOne(targetEntity=address::class, cascade={"persist", "remove"})
     */
    private $address;

//    /**
//     * @ORM\OneToOne(targetEntity=Address::class, mappedBy="patient", cascade={"persist", "remove"})
//     */
//    private ?Address $address;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getInsuranceNumber(): ?int
    {
        return $this->insuranceNumber;
    }

    public function setInsuranceNumber(int $insuranceNumber): self
    {
        $this->insuranceNumber = $insuranceNumber;

        return $this;
    }

    public function getInsuranceCompany(): ?string
    {
        return $this->insuranceCompany;
    }

    public function setInsuranceCompany(string $insuranceCompany): self
    {
        $this->insuranceCompany = $insuranceCompany;

        return $this;
    }


    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param mixed $birthdate
     */
    public function setBirthdate($birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    public function getPrimaryDoctorId(): ?int
    {
        return $this->primaryDoctorId;
    }

    public function setPrimaryDoctorId(?int $primaryDoctorId): self
    {
        $this->primaryDoctorId = $primaryDoctorId;

        return $this;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }


    public function setUser(?User $user): self
    {
        $this->user = $user;
    }

//    public function getAddress(): ?Address
//    {
//        return $this->address;
//    }
//
//    public function setAddress(?Address $address): self
//    {
//        // unset the owning side of the relation if necessary
//        if ($address === null && $this->address !== null) {
//            $this->address->setPatient(null);
//        }
//
//        // set the owning side of the relation if necessary
//        if ($address !== null && $address->getPatient() !== $this) {
//            $address->setPatient($this);
//        }
//
//        $this->address = $address;
//
//        return $this;
//    }

public function getAddress(): ?address
{
    return $this->address;
}

public function setAddress(?address $address): self
{
    $this->address = $address;

    return $this;
}


}
