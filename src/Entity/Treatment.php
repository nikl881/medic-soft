<?php

namespace App\Entity;

use App\Repository\TreatmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TreatmentRepository::class)
 */
class Treatment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stage;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $urgency;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $indication;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $painIndication;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $refferal;

    /**
     * @ORM\ManyToOne(targetEntity=patient::class, inversedBy="treatments")
     */
    private $patient;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urgencyComment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $existingComplaints;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $weightLoss;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $geneticDisorders;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $formerOperations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $chronicDisorders;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $intoxication;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStage(): ?int
    {
        return $this->stage;
    }

    public function setStage(int $stage): self
    {
        $this->stage = $stage;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getUrgency(): ?bool
    {
        return $this->urgency;
    }

    public function setUrgency(?bool $urgency): self
    {
        $this->urgency = $urgency;

        return $this;
    }

    public function getIndication(): ?string
    {
        return $this->indication;
    }

    public function setIndication(?string $indication): self
    {
        $this->indication = $indication;

        return $this;
    }

    public function getPainIndication(): ?string
    {
        return $this->painIndication;
    }

    public function setPainIndication(?string $painIndication): self
    {
        $this->painIndication = $painIndication;

        return $this;
    }

    public function getRefferal(): ?string
    {
        return $this->refferal;
    }

    public function setRefferal(string $refferal): self
    {
        $this->refferal = $refferal;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getUrgencyComment(): ?string
    {
        return $this->urgencyComment;
    }

    public function setUrgencyComment(?string $urgencyComment): self
    {
        $this->urgencyComment = $urgencyComment;

        return $this;
    }

    public function getExistingComplaints(): ?string
    {
        return $this->existingComplaints;
    }

    public function setExistingComplaints(?string $existingComplaints): self
    {
        $this->existingComplaints = $existingComplaints;

        return $this;
    }

    public function getWeightLoss(): ?string
    {
        return $this->weightLoss;
    }

    public function setWeightLoss(?string $weightLoss): self
    {
        $this->weightLoss = $weightLoss;

        return $this;
    }

    public function getGeneticDisorders(): ?string
    {
        return $this->geneticDisorders;
    }

    public function setGeneticDisorders(?string $geneticDisorders): self
    {
        $this->geneticDisorders = $geneticDisorders;

        return $this;
    }

    public function getFormerOperations(): ?string
    {
        return $this->formerOperations;
    }

    public function setFormerOperations(?string $formerOperations): self
    {
        $this->formerOperations = $formerOperations;

        return $this;
    }

    public function getChronicDisorders(): ?string
    {
        return $this->chronicDisorders;
    }

    public function setChronicDisorders(?string $chronicDisorders): self
    {
        $this->chronicDisorders = $chronicDisorders;

        return $this;
    }

    public function getIntoxication(): ?string
    {
        return $this->intoxication;
    }

    public function setIntoxication(?string $intoxication): self
    {
        $this->intoxication = $intoxication;

        return $this;
    }
}
