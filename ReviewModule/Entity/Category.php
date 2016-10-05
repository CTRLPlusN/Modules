<?php

namespace CTRLPlusN\Modules\ReviewModule\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use CTRLPlusN\Modules\ReviewModule\Entity\Post;
use CTRLPlusN\Components\Extras\Methods\Entity\EntityTrait;
use CTRLPlusN\Components\Extras\Methods\Entity\DescriptionTrait;
use CTRLPlusN\Modules\ReviewModule\Traits\ParentChildrenTrait;

/**
 * Post
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="CTRLPlusN\Modules\ReviewModule\Repository\CategoryRepository")
 */
class Category {

    use ParentChildrenTrait,
        EntityTrait, DescriptionTrait;

    /**
     * Titre de la catégorie
     * @ORM\Column(type="string", length=100, unique=true)
     */
    protected $title;

    /**
     * Slug basé sur le titre de la catégorie
     * @Gedmo\Slug(fields={"title"}, updatable=true)
     * @ORM\Column(length=128, unique=true)
     */
    protected $slug;

    /* Relations avec les entités */

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="category")
     */
    protected $posts;

    /**
     * Constructor
     */
    public function __construct() {
        $this->posts = new ArrayCollection();
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Category
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
     * @return Category
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
     * Add post
     *
     * @param Post $post
     *
     * @return Category
     */
    public function addPost(Post $post) {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param Post $post
     */
    public function removePost(Post $post) {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts() {
        return $this->posts;
    }

}
