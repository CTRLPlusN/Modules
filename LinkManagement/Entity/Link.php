<?php

namespace CTRLPlusN\Modules\LinkManagement\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use CTRLPlusN\Extensions\Entity\PropsTrait\EntityTrait;

/**
 * @ORM\Entity
 * @ORM\Table(name="extlinks")
 */
class Link {

    use EntityTrait;

    /**
     * Titre du lien
     * @ORM\Column(type="string", length=64)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2, max = 128,
     *      minMessage = "Texte trop court minimum : {{ limit }} caractères.",
     *      maxMessage = "Texte trop long maximum : {{ limit }} characters"
     * )
     */
    protected $title;

    /**
     * URL
     * @ORM\Column(type="string", length=128)
     * @Assert\Url(
     *    protocols = {"http", "https"}
     * )
     */
    protected $url;

    public function getTitle() {
        return $this->title;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

}
