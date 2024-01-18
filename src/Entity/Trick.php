<?php

namespace App\Entity;

class Trick
{
    private int $id;
    private string $title;
    private string $intro;
    private string $content;
    private string $creation_date;
    private string $author;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getIntro(): string
    {
        return $this->intro;
    }

    public function setIntro(string $intro): void
    {
        $this->intro = $intro;
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
        return $this->creation_date;
    }

    public function setCreationDate(string $creation_date): void
    {
        $this->creation_date = $creation_date;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }
}