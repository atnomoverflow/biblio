<?php

namespace App\Entity;

use App\Repository\EmprintLivreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmprintLivreRepository::class)
 * @ORM\Table(name="Custom_Emprint_Livre")
 */
class EmprintLivre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Livre::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $livre;
    /**
     * @ORM\ManyToOne(targetEntity=Emprint::class, inversedBy="emprintedLivres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $emprint;
    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="emprintLivres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLivre(): ?Livre
    {
        return $this->livre;
    }

    public function setLivre(?Livre $livre): self
    {
        $this->livre = $livre;

        return $this;
    }

    public function getEmprint(): ?Emprint
    {
        return $this->emprint;
    }

    public function setEmprint(?Emprint $emprint): self
    {
        $this->emprint = $emprint;

        return $this;
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
    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }
}
