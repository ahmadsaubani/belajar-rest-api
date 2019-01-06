<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SupplierRepository")
 */
class Supplier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     * @Groups({"Supplier"})
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * 
     * @Groups({"Supplier"})
     */
    private $namaToko;

    /**
     * @ORM\Column(type="string", length=100)
     * 
     * @Groups({"Supplier"})
     */
    private $alamatToko;

    /**
     * @ORM\Column(type="string", length=100)
     * 
     * @Groups({"Supplier"})
     */
    private $jenisToko;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"Supplier"})
     */
    private $sloganToko;


    /**
     * @ORM\Column(type="string", length=100)
     * 
     * @Groups({"Supplier"})
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="supplier", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="supplier")
     *
     * @Groups({"Supplier"})
     */
    private $product;

    public function __construct()
    {
        $this->supplier = new ArrayCollection();
        $this->product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamaToko(): ?string
    {
        return $this->namaToko;
    }

    public function setNamaToko(string $namaToko): self
    {
        $this->namaToko = $namaToko;

        return $this;
    }

    public function getAlamatToko(): ?string
    {
        return $this->alamatToko;
    }

    public function setAlamatToko(string $alamatToko): self
    {
        $this->alamatToko = $alamatToko;

        return $this;
    }

    public function getJenisToko(): ?string
    {
        return $this->jenisToko;
    }

    public function setJenisToko(string $jenisToko): self
    {
        $this->jenisToko = $jenisToko;

        return $this;
    }

    public function getSloganToko(): ?string
    {
        return $this->sloganToko;
    }

    public function setSloganToko(string $sloganToko): self
    {
        $this->sloganToko = $sloganToko;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->product->contains($product)) {
            $this->product[] = $product;
            $product->setSupplier($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->product->contains($product)) {
            $this->product->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getSupplier() === $this) {
                $product->setSupplier(null);
            }
        }

        return $this;
    }

}
