<?php

namespace App\Entity;

use App\Enum\FormationLevel;
use App\Enum\FormationStatus;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\FormationTeleworking;
use App\Repository\FormationRepository;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $zipcode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $begin_at = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $end_at = null;

    #[ORM\Column(length: 255)]
    private ?string $degree = null;

    /**
     * @var list<string> les financements de la formation
     */
    #[ORM\Column]
    private array $funding = [];

    #[ORM\Column(nullable: true)]
    private ?FormationTeleworking $teleworking = null;

    #[ORM\ManyToOne(inversedBy: 'formations')]
    private ?User $user_id = null;

    #[ORM\Column(length: 255)]
    private ?string $link = null;

    #[ORM\Column]
    private ?FormationLevel $requiredLevel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(?string $zipcode): static
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getBeginAt(): ?\DateTimeImmutable
    {
        return $this->begin_at;
    }

    public function setBeginAt(?\DateTimeImmutable $begin_at): static
    {
        $this->begin_at = $begin_at;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->end_at;
    }

    public function setEndAt(?\DateTimeImmutable $end_at): static
    {
        $this->end_at = $end_at;

        return $this;
    }

    public function getDegree(): ?string
    {
        return $this->degree;
    }

    public function setDegree(?string $degree): static
    {
        $this->degree = $degree;

        return $this;
    }

    public function getFunding(): array
    {
        return $this->funding;
    }

    public function setFunding(array $funding): static
    {
        $this->funding = $funding;

        return $this;
    }

    public function isTeleworking(): ?FormationTeleworking
    {
        return $this->teleworking;
    }

    public function setTeleworking(?FormationTeleworking $teleworking): static
    {
        $this->teleworking = $teleworking;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function getTeleworking(): ?FormationTeleworking
    {
        return $this->teleworking;
    }

    public function getRequiredLevel(): ?FormationLevel
    {
        return $this->requiredLevel;
    }

    public function setRequiredLevel(?FormationLevel $requiredLevel): static
    {
        $this->requiredLevel = $requiredLevel;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function isStatus(): ?FormationStatus
    {
        return $this->status;
    }

    public function getStatus(): ?FormationStatus
    {
        return $this->status;
    }

    public function setStatus(FormationStatus $status): static
    {
        $this->status = $status;

        return $this;
    }
}
