<?php

namespace App\Entity\Messaging;

use App\Entity\Account\Profile;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Messaging\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Messaging\SentMessage", inversedBy="receivedMessage", cascade={"persist", "remove"})
     */
    private $sentMessage;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Messaging\ReceivedMessage", inversedBy="message", cascade={"persist", "remove"})
     */
    private $receivedMessage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $senderName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $recipientName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSentMessage(): ?SentMessage
    {
        return $this->sentMessage;
    }

    public function setSentMessage(?SentMessage $sentMessage): self
    {
        $this->sentMessage = $sentMessage;

        return $this;
    }

    public function getReceivedMessage(): ?ReceivedMessage
    {
        return $this->receivedMessage;
    }

    public function setReceivedMessage(?ReceivedMessage $receivedMessage): self
    {
        $this->receivedMessage = $receivedMessage;

        return $this;
    }

    public function getSenderName(): ?string
    {
        return $this->senderName;
    }

    public function setSenderName(string $senderName): self
    {
        $this->senderName = $senderName;

        return $this;
    }

    public function getRecipientName(): ?string
    {
        return $this->recipientName;
    }

    public function setRecipientName(string $recipientName): self
    {
        $this->recipientName = $recipientName;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
