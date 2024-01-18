<?php

namespace App\Entity;

class Comment
{
private int $id;
private string $content;
private string $creationDate;
private int $commentPostId;
private int $commentUserId;

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

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    public function setCreationDate(string $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    public function getCommentPostId(): int
    {
        return $this->commentPostId;
    }

    public function setCommentPostId(int $commentPostId): void
    {
        $this->commentPostId = $commentPostId;
    }

    public function getCommentUserId(): int
    {
        return $this->commentUserId;
    }

    public function setCommentUserId(int $commentUserId): void
    {
        $this->commentUserId = $commentUserId;
    }
}