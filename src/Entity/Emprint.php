<?php

namespace App\Entity;

use App\Repository\EmprintRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmprintRepository::class)
 */
class Emprint
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_emprint;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="emprints")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=EmprintLivre::class,mappedBy="emprint")
     */
    private $emprintedLivres;



    public function __construct()
    {
        $this->emprintedLivres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEmprint(): ?\DateTimeInterface
    {
        return $this->date_emprint;
    }

    public function setDateEmprint(\DateTimeInterface $date_emprint): self
    {
        $this->date_emprint = $date_emprint;

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

    /**
     * @return Collection|EmprintLivre[]
     */
    public function getEmprintedLivres(): Collection
    {
        return $this->emprintedLivres;
    }

    public function addEmprintedLivres(EmprintLivre $emprintedLivre): self
    {
        if (!$this->emprintedLivres->contains($emprintedLivre)) {
            $this->emprintedLivres[] = $emprintedLivre;
        }

        return $this;
    }

    public function removeEmprintedLivres(EmprintLivre $emprintedLivre): self
    {
        $this->emprintedLivres->removeElement($emprintedLivre);

        return $this;
    }
}
