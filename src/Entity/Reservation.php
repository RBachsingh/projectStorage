<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Items;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationTime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastUpdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=ReservationItem::class, mappedBy="reservation")
     */
    private $reservationitems;

    /**
     * @ORM\OneToMany(targetEntity=ReservationComment::class, mappedBy="reservation")
     */
    private $reservationcomments;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=reservationItem::class, inversedBy="reservations")
     */
    private $groupId;

    private $items;

    public function __construct()
    {
        $this->reservationitems = new ArrayCollection();
        $this->reservationcomments = new ArrayCollection();
        $this->groupId = new ArrayCollection();
        $this->items = new ArrayCollection();

    }


    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItems(Items $items): self
    {
        if (!$this->items->contains($items)){
            $this->items[] = $items;
        }
        return $this;
    }

    public function removeItems(Items $items): self
    {
        $this->items->removeElement($items);

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCreationTime(): ?\DateTimeInterface
    {
        return $this->creationTime;
    }

    public function setCreationTime(\DateTimeInterface $creationTime): self
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(\DateTimeInterface $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

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

    /**
     * @return Collection<int, Reservationitem>
     */
    public function getReservationitems(): Collection
    {
        return $this->reservationitems;
    }

    public function addReservationitem(Reservationitem $reservationitem): self
    {
        if (!$this->reservationitems->contains($reservationitem)) {
            $this->reservationitems[] = $reservationitem;
            $reservationitem->setReservation($this);
        }

        return $this;
    }

    public function removeReservationitem(Reservationitem $reservationitem): self
    {
        if ($this->reservationitems->removeElement($reservationitem)) {
            // set the owning side to null (unless already changed)
            if ($reservationitem->getReservation() === $this) {
                $reservationitem->setReservation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservationcomment>
     */
    public function getReservationcomments(): Collection
    {
        return $this->reservationcomments;
    }

    public function addReservationcomment(Reservationcomment $reservationcomment): self
    {
        if (!$this->reservationcomments->contains($reservationcomment)) {
            $this->reservationcomments[] = $reservationcomment;
            $reservationcomment->setReservation($this);
        }

        return $this;
    }

    public function removeReservationcomment(Reservationcomment $reservationcomment): self
    {
        if ($this->reservationcomments->removeElement($reservationcomment)) {
            // set the owning side to null (unless already changed)
            if ($reservationcomment->getReservation() === $this) {
                $reservationcomment->setReservation(null);
            }
        }

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, reservationItem>
     */
    public function getGroupId(): Collection
    {
        return $this->groupId;
    }

    public function addGroupId(reservationItem $groupId): self
    {
        if (!$this->groupId->contains($groupId)) {
            $this->groupId[] = $groupId;
        }

        return $this;
    }

    public function removeGroupId(reservationItem $groupId): self
    {
        $this->groupId->removeElement($groupId);

        return $this;
    }

}
