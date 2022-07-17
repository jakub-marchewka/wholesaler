<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[UniqueEntity(fields: ['slug'])]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: "doctrine.uuid_generator")]
    private ?Uuid $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\ManyToOne(targetEntity: ProductCategory::class, inversedBy: 'products')]
    private $category;

    #[ORM\Column(type: 'integer')]
    private ?int $price;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $priceOld;

    #[ORM\Column(type: 'integer')]
    private ?int $stock;

    #[ORM\Column(type: 'integer')]
    private ?int $weight;

    #[ORM\Column(type: 'boolean')]
    private bool $active;

    #[ORM\ManyToOne(targetEntity: ProductVat::class, inversedBy: 'products')]
    private $vat;

    #[ORM\ManyToMany(
        targetEntity: User::class,
        inversedBy: 'subscribtions',
        cascade: ['persist', "remove"],
        orphanRemoval: true
    )]
    private $subscribers;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $slug;

    #[ORM\OneToMany(mappedBy: 'Product', targetEntity: ProductComment::class, orphanRemoval: true)]
    private $productComments;

    public function __construct()
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


    public function getSubscribers()
    {
        return $this->subscribers;
    }

    public function addSubscriber($subscriber): self
    {
        if (!$this->subscribers->contains($subscriber)) {
            $this->subscribers[] = $subscriber;
        }

        return $this;
    }

    public function removeSubscriber($subscriber): self
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

    public function getProductComments()
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
