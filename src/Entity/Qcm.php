<?php

namespace App\Entity;

use App\Repository\QcmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QcmRepository::class)]
class Qcm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column]
    private ?int $NbrQuestion = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'qcms')]
    private Collection $Jouer;

    public function __construct()
    {
        $this->Jouer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getNbrQuestion(): ?int
    {
        return $this->NbrQuestion;
    }

    public function setNbrQuestion(int $NbrQuestion): self
    {
        $this->NbrQuestion = $NbrQuestion;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getJouer(): Collection
    {
        return $this->Jouer;
    }

    public function addJouer(User $jouer): self
    {
        if (!$this->Jouer->contains($jouer)) {
            $this->Jouer->add($jouer);
        }

        return $this;
    }

    public function removeJouer(User $jouer): self
    {
        $this->Jouer->removeElement($jouer);

        return $this;
    }
}
