<?php

namespace App\Entity\Order;

use App\Entity\Delivery;
use App\Entity\User;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: "doctrine.uuid_generator")]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\ManyToOne(targetEntity: Delivery::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: true)]
    private $delivery;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: OrderStatus::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: true)]
    private $status;

    #[ORM\OneToMany(mappedBy: 'orderEntity', targetEntity: OrderStatusLog::class, orphanRemoval: true)]
    private $orderStatusLogs;

    #[ORM\OneToMany(mappedBy: 'orderEntity', targetEntity: OrderProduct::class, orphanRemoval: true)]
    private $orderProducts;

    #[ORM\OneToOne(mappedBy: 'orderEntity', targetEntity: OrderAddress::class, cascade: ['persist', 'remove'])]
    private $orderAddress;

    public function __construct()
    {
        $this->orderStatusLogs = new ArrayCollection();
        $this->orderProducts = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
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

    public function getDelivery(): ?Delivery
    {
        return $this->delivery;
    }

    public function setDelivery(?Delivery $delivery): self
    {
        $this->delivery = $delivery;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getStatus(): ?OrderStatus
    {
        return $this->status;
    }

    public function setStatus(?OrderStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, OrderStatusLog>
     */
    public function getOrderStatusLogs(): Collection
    {
        return $this->orderStatusLogs;
    }

    public function addOrderStatusLog(OrderStatusLog $orderStatusLog): self
    {
        if (!$this->orderStatusLogs->contains($orderStatusLog)) {
            $this->orderStatusLogs[] = $orderStatusLog;
            $orderStatusLog->setOrderEntity($this);
        }

        return $this;
    }

    public function removeOrderStatusLog(OrderStatusLog $orderStatusLog): self
    {
        if ($this->orderStatusLogs->removeElement($orderStatusLog)) {
            // set the owning side to null (unless already changed)
            if ($orderStatusLog->getOrderEntity() === $this) {
                $orderStatusLog->setOrderEntity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrderProduct>
     */
    public function getOrderProducts(): Collection
    {
        return $this->orderProducts;
    }

    public function addOrderProduct(OrderProduct $orderProduct): self
    {
        if (!$this->orderProducts->contains($orderProduct)) {
            $this->orderProducts[] = $orderProduct;
            $orderProduct->setOrderEntity($this);
        }

        return $this;
    }

    public function removeOrderProduct(OrderProduct $orderProduct): self
    {
        if ($this->orderProducts->removeElement($orderProduct)) {
            // set the owning side to null (unless already changed)
            if ($orderProduct->getOrderEntity() === $this) {
                $orderProduct->setOrderEntity(null);
            }
        }

        return $this;
    }

    public function getOrderAddress(): ?OrderAddress
    {
        return $this->orderAddress;
    }

    public function setOrderAddress(OrderAddress $orderAddress): self
    {
        // set the owning side of the relation if necessary
        if ($orderAddress->getOrderEntity() !== $this) {
            $orderAddress->setOrderEntity($this);
        }

        $this->orderAddress = $orderAddress;

        return $this;
    }
}
