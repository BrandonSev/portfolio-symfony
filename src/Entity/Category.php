<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: UnderCategory::class)]
    private $underCategories;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Technology::class)]
    private $technologies;

    public function __construct()
    {
        $this->underCategories = new ArrayCollection();
        $this->technologies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|UnderCategory[]
     */
    public function getUnderCategories(): Collection
    {
        return $this->underCategories;
    }

    public function addUnderCategory(UnderCategory $underCategory): self
    {
        if (!$this->underCategories->contains($underCategory)) {
            $this->underCategories[] = $underCategory;
            $underCategory->setCategory($this);
        }

        return $this;
    }

    public function removeUnderCategory(UnderCategory $underCategory): self
    {
        if ($this->underCategories->removeElement($underCategory)) {
            // set the owning side to null (unless already changed)
            if ($underCategory->getCategory() === $this) {
                $underCategory->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Technology[]
     */
    public function getTechnologies(): Collection
    {
        return $this->technologies;
    }

    public function addTechnology(Technology $technology): self
    {
        if (!$this->technologies->contains($technology)) {
            $this->technologies[] = $technology;
            $technology->setCategory($this);
        }

        return $this;
    }

    public function removeTechnology(Technology $technology): self
    {
        if ($this->technologies->removeElement($technology)) {
            // set the owning side to null (unless already changed)
            if ($technology->getCategory() === $this) {
                $technology->setCategory(null);
            }
        }

        return $this;
    }
}
