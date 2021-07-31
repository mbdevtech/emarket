<?php

namespace App\Entity\Messaging;

use App\Entity\Account\Profile;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Messaging\ReceivedMessageRepository")
 */
class ReceivedMessage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Account\Profile", inversedBy="receivedMessages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profile;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Messaging\Message", mappedBy="receivedMessage", cascade={"persist", "remove"})
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    public function getMessage(): ?Message
    {
        return $this->message;
    }

    public function setMessage(?Message $message): self
    {
        $this->message = $message;

        // set (or unset) the owning side of the relation if necessary
        $newReceivedMessage = null === $message ? null : $this;
        if ($message->getReceivedMessage() !== $newReceivedMessage) {
            $message->setReceivedMessage($newReceivedMessage);
        }

        return $this;
    }
}
