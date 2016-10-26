<?php

namespace CTRLPlusN\Modules\SubscriberModule\Entity\Superclass;

use CTRLPlusN\Extensions\Entity\PropsTrait\EntityTrait;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/** @ORM\MappedSuperclass */
class Information {

    use EntityTrait;

    /** @ORM\Column(type="string") */
    protected $nom;

    /** @ORM\Column(type="string") */
    protected $prenom;

    /** @ORM\Column(type="string") */
    protected $birthday;

    /** @ORM\Column(type="string") */
    protected $rue;

    /** @ORM\Column(type="string") */
    protected $cp;

    /** @ORM\Column(type="string") */
    protected $ville;

    /** @ORM\Column(type="string") */
    protected $email;

    /** @ORM\Column(type="string") */
    protected $phone;

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getBirthday() {
        return $this->birthday;
    }

    public function getRue() {
        return $this->rue;
    }

    public function getCp() {
        return $this->cp;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setBirthday($birthday) {
        $this->birthday = $birthday;
    }

    public function setRue($rue) {
        $this->rue = $rue;
    }

    public function setCp($cp) {
        $this->cp = $cp;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }
}
