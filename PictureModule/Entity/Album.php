<?php

namespace CTRLPlusN\Modules\PictureModule\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use CTRLPlusN\Modules\PictureModule\Entity\Image;
use CTRLPlusN\Extensions\Entity\PropsTrait\EntityTrait;

/**
 * Album
 * L'album peut contenir plusieurs Images
 * @ORM\Table(name="picture_album")
 * @ORM\Entity()
 */
class Album {

    use EntityTrait;

    /**
     * Titre de l'album
     * @ORM\Column(type="string", length=128, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2, max = 128,
     *      minMessage = "Texte trop court minimum : {{ limit }} caractères.",
     *      maxMessage = "Texte trop long maximum : {{ limit }} characters"
     * )
     */
    protected $title;

    /**
     * Slug basé sur le titre de la catégorie
     * @Gedmo\Slug(fields={"title", "id"}, updatable=true)
     * @ORM\Column(length=128, unique=true)
     */
    protected $slug;

    /**
     *  Courte description de l'album
     * @ORM\Column(type="string", length=512, nullable=true)
     * @Assert\Length(
     *      min = 16, max = 512,
     *      minMessage = "Texte trop court minimum : {{ limit }} caractères.",
     *      maxMessage = "Texte trop long maximum : {{ limit }} characters"
     * )
     */
    protected $description;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="album", fetch="EAGER")
     */
    protected $images;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Album
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Album
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Album
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add image
     *
     * @param \CTRLPlusN\Bundles\AppBundle\Entity\Image $image
     *
     * @return Album
     */
    public function addImage(Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \CTRLPlusN\Bundles\AppBundle\Entity\Image $image
     */
    public function removeImage(Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }
}
