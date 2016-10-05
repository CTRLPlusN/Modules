<?php

namespace CTRLPlusN\Modules\GuestbookModule\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use CTRLPlusN\Extensions\Entity\PropsTrait\EntityTrait;

/**
 * Message du Guestbook
 * Usage : Créer une entité Message dans son AppBundle et extend à celle-ci.
 * @ORM\Entity()
 * @ORM\Table(name="guestbook_messages")
 */
class Message {

    use EntityTrait;

    /**
     * Auteur du message
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 64,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    protected $author;

    /**
     * Contenu du message
     * @ORM\Column(type="string", length=512)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 16,
     *      max = 512,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    protected $content;

    public function getAuthor() {
        return $this->author;
    }

    public function getContent() {
        return $this->content;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function setContent($content) {
        $this->content = $content;
    }

}
