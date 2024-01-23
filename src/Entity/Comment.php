<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;
    #[ORM\Column(type: "string", length: 255)]
    private string $content;
    #[ORM\Column(type: "datetime")]
    private \DateTime $creationDate;
    #[ORM\ManyToOne(targetEntity: Trick::class)]
    #[ORM\JoinColumn(name: 'trick_id', referencedColumnName: 'id')]
    private ?Trick $commentPostId;
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $commentUserId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    public function getCommentPostId(): ?Trick
    {
        return $this->commentPostId;
    }

    public function setCommentPostId(?Trick $commentPostId): void
    {
        $this->commentPostId = $commentPostId;
    }

    public function getCommentUserId(): ?User
    {
        return $this->commentUserId;
    }

    public function setCommentUserId(?User $commentUserId): void
    {
        $this->commentUserId = $commentUserId;
    }
}