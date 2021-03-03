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

    public function getPatient(): ?patient
    {
        return $this->patient;
    }

    public function setPatient(?patient $patient): self
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
}
