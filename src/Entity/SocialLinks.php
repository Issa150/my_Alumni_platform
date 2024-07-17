<?php

namespace App\Entity;

use App\Repository\SocialLinksRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AppAssert;


// Pour le validateur de la limite des liens : on ne peut pas mettre un nombre de liens >= limit.
// La vérification avec les validateurs de symfony n'est pas au niveau de la base de données (on peut rajouter en requete sql autant de liens qu'on veut)
#[ORM\Entity(repositoryClass: SocialLinksRepository::class)]
#[AppAssert\MaxLinks(limit:7)]
class SocialLinks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'socialLinks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }
}
