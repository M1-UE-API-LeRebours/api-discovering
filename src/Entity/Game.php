<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\GameRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ApiResource(
    operations:[
        new Get(
            normalizationContext: ['groups' => ['game:read']]
        ),
        new GetCollection(
            normalizationContext: ['groups' => ['game:read:collection']]
        ),
        new Post(
            normalizationContext: ['groups' => ['game:read']],
            denormalizationContext: ['groups' => ['game:post']]
        ),
        new Put(
            normalizationContext: ['groups' => ['game:read']],
            denormalizationContext: ['groups' => ['game:put']]
        ),
        new Delete()
    ]
)]
class Game
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['game:read', 'game:read:collection'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['game:read','game:read:collection', 'game:post', 'game:put'])]
    private ?string $title = null;

    #[ORM\Column]
    #[Groups(['game:read','game:read:collection', 'game:post', 'game:put'])]
    private ?int $releaseYear = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['game:read', 'game:post', 'game:put'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['game:read','game:read:collection', 'game:post'])]
    private ?Category $category = null;

    #[ORM\Column(length: 255)]
    #[Groups(['game:read','game:read:collection', 'game:post'])]
    private ?string $platform = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseYear(): ?int
    {
        return $this->releaseYear;
    }

    public function setReleaseYear(int $releaseYear): static
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): static
    {
        $this->platform = $platform;

        return $this;
    }
}
