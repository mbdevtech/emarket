<?php

namespace App\Entity\Messaging;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Messaging\SentMessageRepository")
 */
class SentMessage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Messaging\Message", mappedBy="sentMessage", cascade={"persist", "remove"})
     */
    private $receivedMessage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReceivedMessage(): ?Message
    {
        return $this->receivedMessage;
    }

    public function setReceivedMessage(?Message $receivedMessage): self
    {
        $this->receivedMessage = $receivedMessage;

        // set (or unset) the owning side of the relation if necessary
        $newSentMessage = null === $receivedMessage ? null : $this;
        if ($receivedMessage->getSentMessage() !== $newSentMessage) {
            $receivedMessage->setSentMessage($newSentMessage);
        }

        return $this;
    }
}
