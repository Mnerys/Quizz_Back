<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelRepository::class)]
class Level
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Level = null;

    #[ORM\OneToMany(mappedBy: 'level', targetEntity: Question::class)]
    private Collection $Appartenir;

    public function __construct()
    {
        $this->Appartenir = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): ?string
    {
        return $this->Level;
    }

    public function setLevel(string $Level): self
    {
        $this->Level = $Level;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getAppartenir(): Collection
    {
        return $this->Appartenir;
    }

    public function addAppartenir(Question $appartenir): self
    {
        if (!$this->Appartenir->contains($appartenir)) {
            $this->Appartenir->add($appartenir);
            $appartenir->setLevel($this);
        }

        return $this;
    }

    public function removeAppartenir(Question $appartenir): self
    {
        if ($this->Appartenir->removeElement($appartenir)) {
            // set the owning side to null (unless already changed)
            if ($appartenir->getLevel() === $this) {
                $appartenir->setLevel(null);
            }
        }

        return $this;
    }
}
