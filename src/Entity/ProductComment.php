<?php

namespace App\Entity;

use App\Repository\ProductCommentRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ProductCommentRepository::class)]
class ProductComment
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: "doctrine.uuid_generator")]
    private ?Uuid $id;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productComments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'productComments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user;

    #[ORM\Column(type: 'boolean')]
    private bool $active;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?DateTimeImmutable $createdAt;


    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

}
