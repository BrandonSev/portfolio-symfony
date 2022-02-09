<?php

namespace App\Entity;

use App\Repository\TechnologyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TechnologyRepository::class)]
class Technology
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $logo;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'technologies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category;

    #[ORM\ManyToOne(targetEntity: UnderCategory::class, inversedBy: 'technologies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?UnderCategory $under_category;

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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUnderCategory(): ?UnderCategory
    {
        return $this->under_category;
    }

    public function setUnderCategory(?UnderCategory $under_category): self
    {
        $this->under_category = $under_category;

        return $this;
    }
}
