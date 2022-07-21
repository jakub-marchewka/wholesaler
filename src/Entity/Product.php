<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProductCommentRepository;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[UniqueEntity(fields: ['slug'])]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: "doctrine.uuid_generator")]
    #[Ignore]
    private ?Uuid $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[Ignore]
    #[ORM\ManyToOne(targetEntity: ProductCategory::class, inversedBy: 'products')]
    private ?ProductCategory $category;

    #[ORM\Column(type: 'integer')]
    private ?int $price;

    #[Ignore]
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $priceOld;

    #[ORM\Column(type: 'integer')]
    private ?int $stock;

    #[ORM\Column(type: 'integer')]
    private ?int $weight;

    #[Ignore]
    #[ORM\Column(type: 'boolean')]
    private bool $active;

    #[Ignore]
    #[ORM\ManyToOne(targetEntity: ProductVat::class, inversedBy: 'products')]
    private ?ProductVat $vat;

    #[Ignore]
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'subscriptions')]
    private Collection $subscribers;

    #[Ignore]
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $slug;

    #[Ignore]
    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductComment::class, orphanRemoval: true)]
    private Collection $productComments;

    #[Pure] public function __construct()
    {
        $this->subscribers = new ArrayCollection();
        $this->productComments = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?ProductCategory
    {
        return $this->category;
    }

    public function setCategory(?ProductCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPriceOld(): ?int
    {
        return $this->priceOld;
    }

    public function setPriceOld(int $priceOld): self
    {
        $this->priceOld = $priceOld;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

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

    public function getVat(): ?ProductVat
    {
        return $this->vat;
    }

    public function setVat(?ProductVat $vat): self
    {
        $this->vat = $vat;

        return $this;
    }


    public function getSubscribers(): Collection
    {
        return $this->subscribers;
    }

    public function addSubscriber(User $subscriber): self
    {
        if (!$this->subscribers->contains($subscriber)) {
            $this->subscribers[] = $subscriber;
        }

        return $this;
    }

    public function removeSubscriber(User $subscriber): self
    {
        $this->subscribers->removeElement($subscriber);

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getProductComments(): Collection
    {
        return $this->productComments;
    }

    public function addProductComment(ProductComment $productComment): self
    {
        if (!$this->productComments->contains($productComment)) {
            $this->productComments[] = $productComment;
            $productComment->setProduct($this);
        }

        return $this;
    }

    public function removeProductComment(ProductComment $productComment): self
    {
        if ($this->productComments->removeElement($productComment)) {
            // set the owning side to null (unless already changed)
            if ($productComment->getProduct() === $this) {
                $productComment->setProduct(null);
            }
        }

        return $this;
    }
}
