<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TrickRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: TrickRepository::class)]
#[UniqueEntity('title')]
#[ORM\HasLifecycleCallbacks]
class Trick
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $slug;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $title = null;
    #[ORM\Column(nullable: true)]
    private ?string $intro = null;
    #[ORM\Column(type: Types::TEXT)]
    private ?string $content;
    #[ORM\Column]
    private \DateTimeImmutable $creation_date;

    #[ORM\ManyToOne(targetEntity: User::class, cascade: ['persist'])]
    private ?User $author = null;

    #[ORM\ManyToOne(targetEntity: Category::class, cascade: ['persist'], inversedBy: 'tricks')]
    private Category $category;

    /**
     * @var Collection<int, UploadMedia>
     */
    #[ORM\OneToMany(mappedBy: 'trick', targetEntity: UploadMedia::class, cascade: ['remove'])]
    private Collection $medias;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(mappedBy: 'trick', targetEntity: Comment::class, cascade: ['remove'])]
    private Collection $comments;

    /**
     * @var Collection<int, ExternalVideo>
     */
    #[ORM\OneToMany(mappedBy: 'trick', targetEntity: ExternalVideo::class, cascade: ['persist', 'remove'])]
    private Collection $externalVideo;

    #[ORM\Column]
    private ?\DateTimeImmutable $updateAt = null;

    public function __construct()
    {
        $this->medias        = new ArrayCollection();
        $this->comments      = new ArrayCollection();
        $this->creation_date = new \DateTimeImmutable();
        $this->externalVideo = new ArrayCollection();
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

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
    public function getTitle(): ?string
    {
        return $this->title;
    }

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

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    public function getCreationDate(): ?\DateTimeImmutable
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeImmutable $creation_date): void
    {
        $this->creation_date = $creation_date;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updatedTimestamps(): void
    {
        $now = new \DateTimeImmutable('now');
        $this->setUpdateAt($now);

        if (! $this->getCreationDate()) {
            $this->setCreationDate($now);
        }
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return Collection<int, UploadMedia>
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(UploadMedia $media): void
    {
        if (! $this->medias->contains($media)) {
            $this->medias[] = $media;
            $media->setTrick($this);
        }
    }

    public function removeMedia(UploadMedia $media): void
    {
        if ($this->medias->removeElement($media)) {
            if ($media->getTrick() === $this) {
                $media->setTrick(null);
            }
        }
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (! $this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setTrick($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            if ($comment->getTrick() === $this) {
                $comment->setTrick(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ExternalVideo>
     */
    public function getExternalVideo(): Collection
    {
        return $this->externalVideo;
    }

    /**
     * @param Collection<int, ExternalVideo> $externalVideo
     */
    public function setExternalVideo(Collection $externalVideo): void
    {
        $this->externalVideo = $externalVideo;
    }

    public function addExternalVideo(ExternalVideo $externalVideo): static
    {
        if (! $this->externalVideo->contains($externalVideo)) {
            $this->externalVideo->add($externalVideo);
            $externalVideo->setTrick($this);
        }

        return $this;
    }

    public function removeExternalVideo(ExternalVideo $externalVideo): static
    {
        if ($this->externalVideo->removeElement($externalVideo)) {
            if ($externalVideo->getTrick() === $this) {
                $externalVideo->setTrick(null);
            }
        }

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeImmutable $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }
}
