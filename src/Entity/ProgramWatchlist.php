<?php

namespace App\Entity;

use App\Repository\ProgramWatchlistRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgramWatchlistRepository::class)
 */
class ProgramWatchlist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Program::class, inversedBy="favorites")
     */
    private $program;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="favoritesPrograms")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProgram(): ?Program
    {
        return $this->program;
    }

    public function setProgram(?Program $program): self
    {
        $this->program = $program;

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
}
