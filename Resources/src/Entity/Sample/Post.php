<?php

namespace App\Entity\Sample;

use App\Repository\Sample\PostRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use http\Encoding\Stream;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Category;

    #[ORM\Column(type: 'text', nullable: true)]
    private $Content;

    #[ORM\Column(type: 'string', length: 1024, nullable: true)]
    private $Thumbnail;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Tag;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Status;

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

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(?string $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(?string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->Thumbnail;
    }

    public function setThumbnail(?string $Thumbnail): self
    {
        $this->Thumbnail = $Thumbnail;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->Tag;
    }

    public function setTag(?string $Tag): self
    {
        $this->Tag = $Tag;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(?string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }
}
