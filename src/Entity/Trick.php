<?php

namespace App\Entity;

use App\Repository\TrickRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrickRepository::class)]
class Trick
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;
    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private string $title;
    #[ORM\Column]
    private ?string $intro;
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content;
    #[ORM\Column(options: ["default" => "CURRENT_TIMESTAMP"])]
    private DateTime $creation_date;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private User $author;

    #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: 'tricks')]
    private Collection $tags;

    #[ORM\OneToMany(mappedBy: "trick", targetEntity: Media::class)]
    private Collection $medias;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->medias = new ArrayCollection();
    }

    /**
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int | null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return ?string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string | null  $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return ?string
     */
    public function getIntro(): ?string
    {
        return $this->intro;
    }

    /**
     * @param string | null $intro
     */
    public function setIntro(?string $intro): void
    {
        $this->intro = $intro;
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
        return $this->creation_date;
    }

    /**
     * @param DateTime $creation_date
     */
    public function setCreationDate(DateTime $creation_date): void
    {
        $this->creation_date = $creation_date;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @param Tag $tag
     */
    public function addTag(Tag $tag): void
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addTrick($this);
        }
    }

    /**
     * @param Tag $tag
     */
    public function removeTag(Tag $tag): void
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeTrick($this);
        }
    }

    /**
     * @return Collection
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    /**
     * @param Media $media
     */
    public function addMedia(Media $media): void
    {
        if (!$this->medias->contains($media)) {
            $this->medias[] = $media;
            $media->setTrick($this);
        }
    }

    /**
     * @param Media $media
     */
    public function removeMedia(Media $media): void
    {
        if ($this->medias->removeElement($media)) {
            if ($media->getTrick() === $this) {
                $media->setTrick(null);
            }
        }
    }
}
