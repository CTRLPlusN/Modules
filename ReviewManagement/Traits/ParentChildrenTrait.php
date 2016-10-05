<?php

namespace CTRLPlusN\Modules\ReviewManagement\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use CTRLPlusN\Modules\ReviewManagement\Entity\Category;

trait ParentChildrenTrait {

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children", fetch="EAGER")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    protected $children;

    public function __construct() {
        $this->children = new ArrayCollection();
    }

    public function addChild(Category $category) {
        $this->children[] = $category;

        return $this;
    }

    public function removeChild(Category $category) {
        $this->children->removeElement($category);
    }

    public function getChildren() {
        return $this->children;
    }

    public function setParent(Category $parent = null) {
        $this->parent = $parent;

        return $this;
    }

    public function getParent() {
        return $this->parent;
    }

}
