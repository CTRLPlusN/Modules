<?php

namespace CTRLPlusN\Modules\StaticPageModule\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use CTRLPlusN\Extensions\Entity\PropsTrait\EntityTrait;

/**
 *  Page
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="static_page")
 * @ORM\Entity(repositoryClass="CTRLPlusN\Modules\StaticPageModule\Repository\PageRepository")
 */
class Page {

    use EntityTrait;

    /**
     * Titre de la page
     * @ORM\Column(type="string", length=100)
     */
    protected $title;

    /**
     * Slug basé sur le titre de la page
     * @Gedmo\Slug(fields={"title"}, updatable=true)
     * @ORM\Column(length=128, unique=true)
     */
    protected $slug;

    /**
     * illustration de la page (URL)
     * @ORM\Column(type="string", length=255, nullable=true))
     */
    protected $image;

    /**
     *  Résumé du contenu de la page (à entrer manuellement)
     * @ORM\Column(type="string", length=220, nullable=true)
     */
    protected $excerpt = null;

    /**
     * Path 
     * @ORM\Column(length=128, nullable=true, type="string")
     */
    protected $path;

    /**
     * Référence unique
     * @ORM\Column(length=128, nullable=false, type="string")
     */
    protected $ref;

    /**
     * vue
     * @ORM\Column(length=128, nullable=true, type="string")
     */
    protected $view;
    
    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Page")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Page", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    /**
     * Constructor
     */
    public function __construct() {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Affichage du label indenté dans un champ select
     */
    public function getIndentedName() {
        return str_repeat( " - - ", $this->lvl) . $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Page
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
     * @return Page
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
     * Set image
     *
     * @param string $image
     *
     * @return Page
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

    /**
     * Set excerpt
     *
     * @param string $excerpt
     *
     * @return Page
     */
    public function setExcerpt($excerpt) {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * Get excerpt
     *
     * @return string
     */
    public function getExcerpt() {
        return $this->excerpt;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Page
     */
    public function setPath($path) {
        $this->path = '';
        foreach ($path as $part) {
            $this->path .= $part->getSlug() . '/';
        }

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Set ref
     *
     * @param string $ref
     *
     * @return Page
     */
    public function setRef($ref) {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string
     */
    public function getRef() {
        return $this->ref;
    }

    /**
     * Set lft
     *
     * @param integer $lft
     *
     * @return Page
     */
    public function setLft($lft) {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft() {
        return $this->lft;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     *
     * @return Page
     */
    public function setLvl($lvl) {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl() {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     *
     * @return Page
     */
    public function setRgt($rgt) {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt() {
        return $this->rgt;
    }

    /**
     * Set root
     *
     * @param \CTRLPlusN\Bundles\AppBundle\Entity\Page $root
     *
     * @return Page
     */
    public function setRoot(Page $root = null) {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return \CTRLPlusN\Bundles\AppBundle\Entity\Page
     */
    public function getRoot() {
        return $this->root;
    }

    /**
     * Set parent
     *
     * @param \CTRLPlusN\Bundles\AppBundle\Entity\Page $parent
     *
     * @return Page
     */
    public function setParent(Page $parent = null) {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \CTRLPlusN\Bundles\AppBundle\Entity\Page
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * Add child
     *
     * @param \CTRLPlusN\Bundles\AppBundle\Entity\Page $child
     *
     * @return Page
     */
    public function addChild(Page $child) {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \CTRLPlusN\Bundles\AppBundle\Entity\Page $child
     */
    public function removeChild(Page $child) {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren() {
        return $this->children;
    }

    public function getView() {
        return $this->view;
    }

    public function setView($view) {
        $this->view = $view;
    }

}
