<?php

namespace App\Entity;

use App\Repository\EmploiRepository;
use App\Enum\EmploiTeleworking;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmploiRepository::class)]
class Emploi
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
    private ?string $entreprise = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $zipcode = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    /**
     * @var list<string> les compétences de l'emploi
     */
    #[ORM\Column(length: 255)]
    private array $skills = [];

    #[ORM\Column(length: 255)]
    private ?string $field = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $publication_date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $limit_offer = null;

    #[ORM\Column(nullable: true)]
    private ?EmploiTeleworking $teleworking = null;

    /**
     * @var list<string> les contracts de l'emploi
     */
    #[ORM\Column]
    private array $contract = [];

    #[ORM\ManyToOne(inversedBy: 'emplois')]
    private ?user $user_id = null;

    #[ORM\Column(length: 255)]
    private ?string $link = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

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

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(?string $entreprise): static
    {
        $this->entreprise = $entreprise;

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

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function setSkills(array $skills): static
    {
        $this->skills = $skills;

        return $this;
    }

    public function getField(): ?string
    {
        return $this->field;
    }

    public function setField(?string $field): static
    {
        $this->field = $field;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publication_date;
    }

    public function setPublicationDate(?\DateTimeInterface $publication_date): static
    {
        $this->publication_date = $publication_date;

        return $this;
    }

    public function getLimitOffer(): ?\DateTimeInterface
    {
        return $this->limit_offer;
    }

    public function setLimitOffer(?\DateTimeInterface $limit_offer): static
    {
        $this->limit_offer = $limit_offer;

        return $this;
    }

    public function isTeleworking(): ?EmploiTeleworking
    {
        return $this->teleworking;
    }

    public function setTeleworking(?EmploiTeleworking $teleworking): static
    {
        $this->teleworking = $teleworking;

        return $this;
    }

    public function getContract(): array
    {
        return $this->contract;
    }

    public function setContract(array $contract): static
    {
        $this->contract = $contract;

        return $this;
    }

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): static
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

    public function getTeleworking(): ?EmploiTeleworking
    {
        return $this->teleworking;
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
}
