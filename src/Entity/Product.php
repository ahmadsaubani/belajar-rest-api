<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @UniqueEntity(fields={"kodeProduct"},errorPath="kodeProduct",
 *      message="This kode product is already in use in our database, please change kode product.")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     * @Groups({"Product"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200, unique=true)
     *
     * @Groups({"Product"})
     */
    private $kodeProduct;

    /**
     * @ORM\Column(type="string", length=200)
     * 
     * @Groups({"Product"})
     */
    private $kodeSupplier;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * Groups({"Product"})
     */
    private $jenisProduct;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Nama Product Tidak Boleh Kosong.")
     *
     * Groups({"Product"})
     */
    private $namaProduct;

    /**
     * @ORM\Column(type="integer", length=255)
     *
     * @Assert\NotBlank(message="Harga Product Tidak Boleh Kosong.")
     * @Assert\Type(type="integer")
     *
     * Groups({"Product"})
     */
    private $hargaProduct;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * Groups({"Product"})
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Supplier", inversedBy="product")
     */
    private $supplier;

    /**
     * @ORM\Column(type="datetime")
     * 
     * @Groups({"Product"})
     */
    private $createdAt;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKodeProduct(): ?string
    {
        return $this->kodeProduct;
    }

    public function setKodeProduct(string $kodeProduct): self
    {
        $this->kodeProduct = $kodeProduct;

        return $this;
    }

    public function getKodeSupplier(): ?string
    {
        return $this->kodeSupplier;
    }

    public function setKodeSupplier(string $kodeSupplier): self
    {
        $this->kodeSupplier = $kodeSupplier;

        return $this;
    }

    public function getJenisProduct(): ?string
    {
        return $this->jenisProduct;
    }

    public function setJenisProduct(string $jenisProduct): self
    {
        $this->jenisProduct = $jenisProduct;

        return $this;
    }

    public function getNamaProduct(): ?string
    {
        return $this->namaProduct;
    }

    public function setNamaProduct(string $namaProduct): self
    {
        $this->namaProduct = $namaProduct;

        return $this;
    }

    public function getHargaProduct(): ?int
    {
        return $this->hargaProduct;
    }

    public function setHargaProduct(int $hargaProduct): self
    {
        $this->hargaProduct = $hargaProduct;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setsupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getcreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setcreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
