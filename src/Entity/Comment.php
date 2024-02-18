<?php

namespace App\Entity;


use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(nullable: true)]
    private ?int $id;
    #[ORM\Column(nullable: true)]
    private ?string $content;
    #[ORM\Column(nullable: true)]
    private DateTime $creationDate;
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

    /**
     * @param int  | null $id
     */
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

    /**
     * @param string | null $content
     */
    public function setContent(?string $content): void
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

    /**
     * @param User | null $commentUserId
     */
    public function setCommentUserId(?User $commentUserId): void
    {
        $this->commentUserId = $commentUserId;
    }
}
