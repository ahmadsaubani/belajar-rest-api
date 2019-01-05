<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="user_account")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     * 
     * @Assert\Length(
     *  min=3,
     *  max=255,
     *  minMessage="The name is too short.",
     *  maxMessage="The name is too long."
     * )
     */
    private $name;


    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     * 
     * @Assert\NotBlank(message="Please enter your name.")
     * @Assert\Length(
     *  min=3,
     *  max=255,
     *  minMessage="The name is too short.",
     *  maxMessage="The name is too long."
     * )
     */
    private $namaToko;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"OwnUser"})
     *
     */
    private $alamatToko;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"OwnUser"})
     */
    private $jenisToko;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"OwnUser"})
     */
    private $sloganToko;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Customer", mappedBy="user", cascade={"persist", "remove"})
     */
    private $customer;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Supplier", mappedBy="user", cascade={"persist", "remove"})
     */
    private $supplier;
    
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

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

    public function getNamaToko(): ?string
    {
        return $this->namaToko;
    }

    public function setNamaToko(string $namaToko): self
    {
        $this->namaToko = $namaToko;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        // set (or unset) the owning side of the relation if necessary
        $newUser = $customer === null ? null : $this;
        if ($newUser !== $customer->getUser()) {
            $customer->setUser($newUser);
        }

        return $this;
    }

    public function getAlamatToko(): ?string
    {
        return $this->alamatToko;
    }

    public function setAlamatToko(?string $alamatToko): self
    {
        $this->alamatToko = $alamatToko;

        return $this;
    }

    public function getJenisToko(): ?string
    {
        return $this->jenisToko;
    }

    public function setJenisToko(?string $jenisToko): self
    {
        $this->jenisToko = $jenisToko;

        return $this;
        
    }

    public function getSloganToko(): ?string
    {
        return $this->sloganToko;
    }

    public function setSloganToko(?string $sloganToko): self
    {
        $this->sloganToko = $sloganToko;

        return $this;
        
    }
    
    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setsupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

        // set (or unset) the owning side of the relation if necessary
        $newUser = $supplier === null ? null : $this;
        if ($newUser !== $supplier->getUser()) {
            $supplier->setUser($newUser);
        }

        return $this;
    }
}
