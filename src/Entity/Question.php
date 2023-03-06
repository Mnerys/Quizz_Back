<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Question = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Comment = null;

    #[ORM\ManyToOne(inversedBy: 'Appartenir')]
    private ?Theme $theme = null;

    #[ORM\ManyToOne(inversedBy: 'Appartenir')]
    private ?Level $level = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Answer::class)]
    private Collection $generer;

    public function __construct()
    {
        $this->generer = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->Question;
    }

    public function setQuestion(string $Question): self
    {
        $this->Question = $Question;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->Comment;
    }

    public function setComment(string $Comment): self
    {
        $this->Comment = $Comment;

        return $this;
    }

    public function getTheme(): ?Theme
    {
        return $this->theme;
    }

    public function setTheme(?Theme $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getLevel(): ?Level
    {
        return $this->level;
    }

    public function setLevel(?Level $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getGenerer(): Collection
    {
        return $this->generer;
    }

    public function addGenerer(Answer $generer): self
    {
        if (!$this->generer->contains($generer)) {
            $this->generer->add($generer);
            $generer->setQuestion($this);
        }

        return $this;
    }

    public function removeGenerer(Answer $generer): self
    {
        if ($this->generer->removeElement($generer)) {
            // set the owning side to null (unless already changed)
            if ($generer->getQuestion() === $this) {
                $generer->setQuestion(null);
            }
        }

        return $this;
    }

   
}