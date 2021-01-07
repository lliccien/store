<?php

namespace App\Entity;

use App\Repository\SupplierRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SupplierRepository::class)
 */
class Supplier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity=Product::class, mappedBy="supplier", cascade={"persist", "remove"})
     */
    private $products;

    public function getId(): ?int
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

    public function getProducts(): ?Product
    {
        return $this->products;
    }

    public function setProducts(?Product $products): self
    {
        // unset the owning side of the relation if necessary
        if ($products === null && $this->products !== null) {
            $this->products->setSupplier(null);
        }

        // set the owning side of the relation if necessary
        if ($products !== null && $products->getSupplier() !== $this) {
            $products->setSupplier($this);
        }

        $this->products = $products;

        return $this;
    }

    /**
     * Generates the magic method
     *
     */
    public function __toString(){

        return $this->name;

    }
}
