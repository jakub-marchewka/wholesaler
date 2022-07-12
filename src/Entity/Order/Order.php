<?php

declare(strict_types=1);

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
    private ?Uuid $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user;

    #[ORM\ManyToOne(targetEntity: Delivery::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Delivery $delivery;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $createdAt;

    #[ORM\ManyToOne(targetEntity: OrderStatus::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: true)]
    private ?OrderStatus $status;

    #[ORM\OneToMany(mappedBy: 'orderEntity', targetEntity: OrderStatusLog::class, orphanRemoval: true)]
    private ArrayCollection $orderStatusLogs;

    #[ORM\OneToMany(mappedBy: 'orderEntity', targetEntity: OrderProduct::class, orphanRemoval: true)]
    private ArrayCollection $orderProducts;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $email;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $phone;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nip;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $companyName;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $street;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $city;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $buildingNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $localNumber;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $postCode;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getNip(): ?string
    {
        return $this->nip;
    }

    public function setNip(string $nip): self
    {
        $this->nip = $nip;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getBuildingNumber(): ?string
    {
        return $this->buildingNumber;
    }

    public function setBuildingNumber(string $buildingNumber): self
    {
        $this->buildingNumber = $buildingNumber;

        return $this;
    }

    public function getLocalNumber(): ?string
    {
        return $this->localNumber;
    }

    public function setLocalNumber(?string $localNumber): self
    {
        $this->localNumber = $localNumber;

        return $this;
    }

    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    public function setPostCode(string $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

}
