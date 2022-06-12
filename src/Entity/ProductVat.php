<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProductVatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductVatRepository::class)]
class ProductVat
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: "doctrine.uuid_generator")]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $value;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }
}
