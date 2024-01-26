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
