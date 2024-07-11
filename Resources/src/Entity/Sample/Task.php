<?php

namespace App\Entity\Sample;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'task')]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: "id", type: 'integer', nullable: false)]
    private ?int $id;

    #[ORM\Column(name: "task", type: 'string', length: 255, nullable: true)]
    private ?string $task;

    #[ORM\Column(name: "dueDate", type: 'date', nullable: true)]
    private ?\DateTime $dueDate;

    #[ORM\Column(name: "title", type: 'string', length: 255, nullable: false)]
    private string $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTask(): ?string
    {
        return $this->task;
    }

    public function setTask(?string $task): self
    {
        $this->task = $task;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(?\DateTimeInterface $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
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


}
