<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembershipTypeRepository")
 */
class MembershipType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     * @Groups({"MembershipType"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * 
     * @Groups({"MembershipType"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * 
     * @Groups({"MembershipType"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Supplier", inversedBy="membershipType")
     */
    private $supplier;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }
}
