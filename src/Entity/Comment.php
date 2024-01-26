<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private int $id;

    private string $content;

    private \DateTime $creationDate;
    #[ORM\ManyToOne(targetEntity: Trick::class)]
    private ?Trick $commentPostId;
    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $commentUserId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return DateTime
     */
    public function getCreationDate(): DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param DateTime $creationDate
     */
    public function setCreationDate(DateTime $creationDate): void
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

    /**
     * @param ?User $commentUserId
     */
    public function setCommentUserId(?User $commentUserId): void
    {
        $this->commentUserId = $commentUserId;
    }
}
