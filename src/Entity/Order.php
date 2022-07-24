<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $address_id;

    /**
     * @ORM\Column(type="text")
     */
    private $address_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $netto;

    /**
     * @ORM\Column(type="integer")
     */
    private $tax;

    /**
     * @ORM\Column(type="integer")
     */
    private $brutto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressId(): ?int
    {
        return $this->address_id;
    }

    public function setAddressId(int $address_id): self
    {
        $this->address_id = $address_id;

        return $this;
    }

    public function getAddressName(): ?string
    {
        return $this->address_name;
    }

    public function setAddressName(string $address_name): self
    {
        $this->address_name = $address_name;

        return $this;
    }

    public function getNetto(): ?int
    {
        return $this->netto;
    }

    public function setNetto(int $netto): self
    {
        $this->netto = $netto;

        return $this;
    }

    public function getTax(): ?int
    {
        return $this->tax;
    }

    public function setTax(int $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    public function getBrutto(): ?int
    {
        return $this->brutto;
    }

    public function setBrutto(int $brutto): self
    {
        $this->brutto = $brutto;

        return $this;
    }
}
