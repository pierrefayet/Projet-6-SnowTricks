<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;
    #[ORM\Column(nullable: true)]
    private ?string $content;
    #[ORM\Column(nullable: true)]
    private \DateTime $creationDate;
    #[ORM\ManyToOne(targetEntity: Trick::class, inversedBy: 'comments')]
    private ?Trick $trick;
    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $commentUserId;

    public function __construct()
    {
        $this->creationDate = new \DateTime();
    }

    /**
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return ?string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
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

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function setTrick(?Trick $trick): void
    {
        $this->trick = $trick;
    }

    /**
     * @return ?User
     */
    public function getCommentUserId(): ?User
    {
        return $this->commentUserId;
    }

    public function setCommentUserId(?User $commentUserId): void
    {
        $this->commentUserId = $commentUserId;
    }
}
