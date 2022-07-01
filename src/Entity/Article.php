<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Arkounay\Bundle\QuickAdminGeneratorBundle\Annotation as QAG;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'date')]
    #[Assert\NotNull]
    #[QAG\Sort]
    private ?\DateTimeInterface $date;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $title;

    #[ORM\Column(type: 'text', nullable: true)]
    #[QAG\Field(formType: TextareaType::class)]
    #[QAG\HideInList]
    private ?string $content;


    #[ORM\Column]
    private bool $published;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'articles')]
    #[Assert\NotNull]
    #[QAG\Field(required: true, position: 2)]
    private ?Category $category = null;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;
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

    public function __toString(): string
    {
        return $this->title;
    }


}
