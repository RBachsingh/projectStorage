<?php

namespace App\Entity;

use App\Repository\ItemsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=ItemsRepository::class)
 */
class Items
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categories;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="bigint")
     */
    private $amount;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $purchasing_value;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $sales_value;

    /**
     * @ORM\Column(type="integer")
     */
    private $alertValue;

    /**
     * @ORM\ManyToMany(targetEntity=ReservationItem::class, inversedBy="items")
     */
    private $reservation_item;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    public function __construct()
    {
        $this->reservation_item = new ArrayCollection();
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

    public function getCategories(): ?string
    {
        return $this->categories;
    }

    public function setCategories(?string $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPurchasingValue(): ?string
    {
        return $this->purchasing_value;
    }

    public function setPurchasingValue(string $purchasing_value): self
    {
        $this->purchasing_value = $purchasing_value;

        return $this;
    }

    public function getSalesValue(): ?string
    {
        return $this->sales_value;
    }

    public function setSalesValue(string $sales_value): self
    {
        $this->sales_value = $sales_value;

        return $this;
    }

    public function getAlertValue(): ?int
    {
        return $this->alertValue;
    }

    public function setAlertValue(int $alertValue): self
    {
        $this->alertValue = $alertValue;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * @return Collection<int, reservationitem>
     */
    public function getReservationItem(): Collection
    {
        return $this->reservation_item;
    }

    public function addReservationItem(reservationitem $reservationItem): self
    {
        if (!$this->reservation_item->contains($reservationItem)) {
            $this->reservation_item[] = $reservationItem;
        }

        return $this;
    }

    public function removeReservationItem(reservationitem $reservationItem): self
    {
        $this->reservation_item->removeElement($reservationItem);

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();

    }
}
