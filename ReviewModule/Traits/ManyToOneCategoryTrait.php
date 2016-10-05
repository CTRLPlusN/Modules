<?php

namespace CTRLPlusN\Modules\ReviewModule\Traits;

use CTRLPlusN\Modules\ReviewModule\Entity\Category;

trait ManyToOneCategoryTrait {

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="posts")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected $category;

    public function setCategory(Category $category = null) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \CTRLPlusN\Bundles\AppBundle\Entity\Category
     */
    public function getCategory() {
        return $this->category;
    }

}
