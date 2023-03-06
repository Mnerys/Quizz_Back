<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Theme = null;

    #[ORM\Column(length: 255)]
    private ?string $Logo = null;

    #[ORM\OneToMany(mappedBy: 'theme', targetEntity: Question::class)]
    private Collection $Appartenir;

   

    public function __construct()
    {
        $this->Appartenir = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTheme(): ?string
    {
        return $this->Theme;
    }

    public function setTheme(string $Theme): self
    {
        $this->Theme = $Theme;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->Logo;
    }

    public function setLogo(string $Logo): self
    {
        $this->Logo = $Logo;

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
            $appartenir->setTheme($this);
        }

        return $this;
    }

    public function removeAppartenir(Question $appartenir): self
    {
        if ($this->Appartenir->removeElement($appartenir)) {
            // set the owning side to null (unless already changed)
            if ($appartenir->getTheme() === $this) {
                $appartenir->setTheme(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
   

    
}