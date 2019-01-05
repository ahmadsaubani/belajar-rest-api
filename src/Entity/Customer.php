<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     * @Groups({"Customer"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     * 
     * @Groups({"Customer"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=150)
     * 
     * @Groups({"Customer"})
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="customer", cascade={"persist", "remove"})
     */
    private $user;

    /**
     *
     * @Groups({"Customer"})
     */
    private $username;

    /**
     *
     * @Groups({"Customer"})
     */
    private $phoneCountryCode;

    /**
     *
     * @Groups({"Customer"})
     */
    private $phoneNumber;

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

    public function getPhoneNumber(): ?string
    {
        if (null === $this->user) {
            return null;
        }
        return $this->user->getPhoneNumber();
    }

    public function getPhoneCountryCode(): ?string
    {
        if (null === $this->user) {
            return null;
        }
        return $this->user->getPhoneCountryCode();
    }

    public function getUserName(): ?string
    {
        if (null === $this->user) {
            return null;
        }

        return $this->user->getUserName();
    }
}
