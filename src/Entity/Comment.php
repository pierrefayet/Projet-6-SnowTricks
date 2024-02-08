<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    public function __construct()
    {
        $this->setCreationDate(new \DateTime());
    }
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(nullable: true)]
    private ?int $id;
    #[ORM\Column(nullable: true)]
    private ?string $content;
    #[ORM\Column(options: ['default' => 'CURRENT_TIMESTAMP'])]
    private \DateTime $creationDate;
    #[ORM\ManyToOne(targetEntity: Trick::class)]
    private ?Trick $commentPostId;
    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $commentUserId;

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

    /**
     * @return ?Trick
     */
    public function getCommentPostId(): ?Trick
    {
        return $this->commentPostId;
    }

    /**
     * @param ?Trick $commentPostId
     */
    public function setCommentPostId(?Trick $commentPostId): void
    {
        $this->commentPostId = $commentPostId;
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
