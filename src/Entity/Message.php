<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $contenu_msg = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_envoi = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $exp_id = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $dest_id = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Annonce $annonce_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenuMsg(): ?string
    {
        return $this->contenu_msg;
    }

    public function setContenuMsg(string $contenu_msg): static
    {
        $this->contenu_msg = $contenu_msg;

        return $this;
    }

    public function getDateEnvoi(): ?\DateTimeInterface
    {
        return $this->date_envoi;
    }

    public function setDateEnvoi(\DateTimeInterface $date_envoi): static
    {
        $this->date_envoi = $date_envoi;

        return $this;
    }

    public function getExpId(): ?Utilisateur
    {
        return $this->exp_id;
    }

    public function setExpId(?Utilisateur $exp_id): static
    {
        $this->exp_id = $exp_id;

        return $this;
    }

    public function getDestId(): ?Utilisateur
    {
        return $this->dest_id;
    }

    public function setDestId(?Utilisateur $dest_id): static
    {
        $this->dest_id = $dest_id;

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
}
