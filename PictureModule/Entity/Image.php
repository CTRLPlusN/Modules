<?php

namespace CTRLPlusN\Modules\PictureModule\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use CTRLPlusN\Extensions\Entity\PropsTrait\EntityTrait;
use CTRLPlusN\Modules\PictureModule\Entity\Album;

/**
 *  Image
 * @ORM\Table(name="picture_image")
 * @ORM\Entity()
 */
class Image {

    use EntityTrait;

    /**
     * Titre de l'image
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2, max = 128,
     *      minMessage = "Texte trop court minimum : {{ limit }} caractères.",
     *      maxMessage = "Texte trop long maximum : {{ limit }} characters"
     * )
     */
    protected $title;

    /**
     * Slug basé sur le titre de l'image
     * @Gedmo\Slug(fields={"title", "id"}, updatable=true)
     * @ORM\Column(length=128, unique=true)
     */
    protected $slug;

    /**
     *  Date de la prise de vue
     * @ORM\Column(type="datetime", nullable=true)
     *  @Assert\DateTime()
     */
    protected $mkdatetime;

    /**
     *  Lieu de la prise de vue
     * @ORM\Column(type="string", length=64, nullable=true)
     * @Assert\Length(
     *      min = 2, max = 64,
     *      minMessage = "Texte trop court minimum : {{ limit }} caractères.",
     *      maxMessage = "Texte trop long maximum : {{ limit }} characters"
     * )
     */
    protected $location;

    /**
     *  Courte description de la photo
     * @ORM\Column(type="string", length=256, nullable=true)
     * @Assert\Length(
     *      min = 16, max = 256,
     *      minMessage = "Texte trop court minimum : {{ limit }} caractères.",
     *      maxMessage = "Texte trop long maximum : {{ limit }} characters"
     * )
     */
    protected $description;

    /**
     *  Chemin relatif de l'image
     * @ORM\Column(type="string", length=256)
     */
    protected $relativePath;

    /**
     *  Légende de la photo (non enregistré dans la base de données)
     * Regroupe toutes les informations de la photo
     * @var type 
     */
    protected $caption;

    /**
     * @ORM\ManyToOne(targetEntity="Album", inversedBy="images", fetch="EAGER")
     * @ORM\JoinColumn(onDelete="SET NULL", nullable=true)
     */
    protected $album;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Image
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Image
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set mkdatetime
     *
     * @param \DateTime $mkdatetime
     *
     * @return Image
     */
    public function setMkdatetime($mkdatetime) {
        $this->mkdatetime = $mkdatetime;

        return $this;
    }

    /**
     * Get mkdatetime
     *
     * @return \DateTime
     */
    public function getMkdatetime() {
        return $this->mkdatetime;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Image
     */
    public function setLocation($location) {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Image
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set album
     *
     * @param \CTRLPlusN\Bundles\AppBundle\Entity\Album $album
     *
     * @return Image
     */
    public function setAlbum(Album $album = null) {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \CTRLPlusN\Bundles\AppBundle\Entity\Album
     */
    public function getAlbum() {
        return $this->album;
    }

    /**
     * Set relativePath
     *
     * @param string $relativePath
     *
     * @return Image
     */
    public function setRelativePath($relativePath) {
        $this->relativePath = $relativePath;

        return $this;
    }

    /**
     * Get relativePath
     *
     * @return string
     */
    public function getRelativePath() {
        return $this->relativePath;
    }

    public function getCaption() {
        return $this->caption = $this->getTitle();
    }

    public function setCaption($caption) {
        $this->caption = $caption;
    }

}
