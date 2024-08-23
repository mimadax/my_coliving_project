<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu_comm = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Annonce $annonce_id = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenuComm(): ?string
    {
        return $this->contenu_comm;
    }

    public function setContenuComm(string $contenu_comm): static
    {
        $this->contenu_comm = $contenu_comm;

        return $this;
    }

    public function getAnnonceId(): ?Annonce
    {
        return $this->annonce_id;
    }

    public function setAnnonceId(?Annonce $annonce_id): static
    {
        $this->annonce_id = $annonce_id;

        return $this;
    }

    public function getUserId(): ?Utilisateur
    {
        return $this->user_id;
    }

    public function setUserId(?Utilisateur $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }
}
