<?php

namespace App\Entity;

use App\Repository\EntryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntryRepository::class)
 */
class Entry
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
	private $guestName;
	
	/**
     * @ORM\Column(type="string", length=100)
     */
    private $guestLocation;

    /**
     * @ORM\Column(type="text")
     */
	private $message;

	/**
     * @ORM\Column(type="datetime")
     */
	private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGuestName(): ?string
    {
        return $this->guestName;
    }

    public function setGuestName(string $guestName): self
    {
        $this->guestName = $guestName;
        return $this;
	}
	
	public function getGuestLocation(): ?string
    {
        return $this->guestLocation;
    }

    public function setGuestLocation(string $guestLocation): self
    {
        $this->guestLocation = $guestLocation;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
	}

	public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
	}
	
}
