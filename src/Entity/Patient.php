<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message="Valid first name is required")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Valid last name is required")
     */
    private $lastName;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(message="Valid birthdate is required")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Valid email is required")
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Type(type={"digit"})
     * @Assert\NotBlank (message="Please enter a valid insurance number")
     * @Assert\Length(max="10", min="6")
     */
    private $insuranceNumber;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Valid insurance company name name is required")
     */
    private $insuranceCompany;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Type(type={"digit"})
     * @Assert\Length(max="8", min="6")
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="user_id")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=address::class, cascade={"persist", "remove"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profileImage;

    /**
     * @ORM\OneToMany(targetEntity=PatientRecordNote::class, mappedBy="patient")
     */
    private $patientRecordNotes;

    /**
     * @ORM\OneToMany(targetEntity=Treatment::class, mappedBy="patient")
     */
    private $treatments;

    public function __construct()
    {
        $this->treatments = new ArrayCollection();
    }

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

    public function getUser(): ?User
    {
        return $this->user;
    }


    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getProfileImage(): ?string
    {
        return $this->profileImage;
    }

    public function setProfileImage(?string $profileImage): self
    {
        $this->profileImage = $profileImage;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPatientRecordNotes()
    {
        return $this->patientRecordNotes;
    }

    /**
     * @param mixed $patientRecordNotes
     */
    public function setPatientRecordNotes($patientRecordNotes): void
    {
        $this->patientRecordNotes = $patientRecordNotes;
    }

    /**
     * @return Collection|Treatment[]
     */
    public function getTreatments(): Collection
    {
        return $this->treatments;
    }

    public function addTreatment(Treatment $treatment): self
    {
        if (!$this->treatments->contains($treatment)) {
            $this->treatments[] = $treatment;
            $treatment->setPatient($this);
        }

        return $this;
    }

    public function removeTreatment(Treatment $treatment): self
    {
        if ($this->treatments->removeElement($treatment)) {
            // set the owning side to null (unless already changed)
            if ($treatment->getPatient() === $this) {
                $treatment->setPatient(null);
            }
        }

        return $this;
    }


}
