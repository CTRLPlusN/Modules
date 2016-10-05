<?php

namespace CTRLPlusN\Modules\ReviewModule\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use CTRLPlusN\Modules\ReviewModule\Model\Preset\DefaultPost;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="CTRLPlusN\Modules\ReviewModule\Repository\PostRepository")
 */
class Post {

    use DefaultPost;

    /**
     * Titre de l'article
     * @ORM\Column(type="string", length=100)
     */
    protected $title;

    /**
     * Slug basé sur le titre et l'id de l'article
     * @Gedmo\Slug(fields={"title", "id"}, updatable=true)
     * @ORM\Column(length=128, unique=true)
     */
    protected $slug;

    /**
     * Contenu de l'article
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * illustration de l'article (URL)
     * @ORM\Column(type="string", length=255)
     */
    protected $image;

    /**
     * Indique si la page est publié (true) ou non(false)
     * @ORM\Column(type="boolean", options={ "default"=true } )
     */
    protected $published = true;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title) {
        $this->title = ucfirst($title);

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
     * @return Post
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
     * Set content
     *
     * @param \longtext $content
     *
     * @return Post
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return \longtext
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Post
     */
    public function setPublished($published) {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished() {
        return $this->published;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Post
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage() {
        return $this->image;
    }


}
