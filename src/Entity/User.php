<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Order\Order;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: "doctrine.uuid_generator")]
    private ?Uuid $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private ?string $email;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $surname;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserAddress::class, orphanRemoval: true)]
    private $address;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $nip;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $phone;

    #[ORM\Column(type: 'boolean')]
    private bool $active = false;

    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'subscribers')]
    private Collection $subscriptions;

    #[ORM\OneToOne(mappedBy: 'user', targetEntity: Cart::class, cascade: ['persist', 'remove'])]
    private ?Cart $cart;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Order::class)]
    private Collection $orders;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ProductComment::class, orphanRemoval: true)]
    private Collection $productComments;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ProductQuestion::class, orphanRemoval: true)]
    private Collection $productQuestions;


    public function __construct()
    {
        $this->address = new ArrayCollection();
        $this->subscriptions = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->productComments = new ArrayCollection();
        $this->productQuestions = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getAddress(): ?Collection
    {
        return $this->address;
    }

    public function addAddress(UserAddress $address): self
    {
        if (!$this->address->contains($address)) {
            $this->address[] = $address;
            $address->setUser($this);
        }

        return $this;
    }

    public function removeAddress(UserAddress $address): self
    {
        if ($this->address->removeElement($address)) {
            // set the owning side to null (unless already changed)
            if ($address->getUser() === $this) {
                $address->setUser(null);
            }
        }

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

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


    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    public function addSubscription($subscription): self
    {
        if (!$this->subscriptions->contains($subscription)) {
            $this->subscriptions[] = $subscription;
            $subscription->addSubscriber($this);
        }

        return $this;
    }

    public function removeSubscription($subscription): self
    {
        if ($this->subscriptions->removeElement($subscription)) {
            $subscription->removeSubscriber($this);
        }

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(Cart $cart): self
    {
        // set the owning side of the relation if necessary
        if ($cart->getUser() !== $this) {
            $cart->setUser($this);
        }

        $this->cart = $cart;

        return $this;
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder($order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setUser($this);
        }

        return $this;
    }

    public function removeOrder($order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getUser() === $this) {
                $order->setUser(null);
            }
        }

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
            $productComment->setUser($this);
        }

        return $this;
    }

    public function removeProductComment(ProductComment $productComment): self
    {
        if ($this->productComments->removeElement($productComment)) {
            // set the owning side to null (unless already changed)
            if ($productComment->getUser() === $this) {
                $productComment->setUser(null);
            }
        }

        return $this;
    }


    public function getProductQuestions(): Collection
    {
        return $this->productQuestions;
    }

    public function addProductQuestion(ProductQuestion $productQuestion): self
    {
        if (!$this->productQuestions->contains($productQuestion)) {
            $this->productQuestions[] = $productQuestion;
            $productQuestion->setUser($this);
        }

        return $this;
    }

    public function removeProductQuestion(ProductQuestion $productQuestion): self
    {
        if ($this->productQuestions->removeElement($productQuestion)) {
            // set the owning side to null (unless already changed)
            if ($productQuestion->getUser() === $this) {
                $productQuestion->setUser(null);
            }
        }

        return $this;
    }


}
