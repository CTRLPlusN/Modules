<?php

namespace CTRLPlusN\Modules\StaticPageModule\Widget\Breadcrumb;

use CTRLPlusN\Components\Breadcrumb\Breadcrumb;

class BreadcrumbWidget extends Breadcrumb {

    public function createBreadcrumb($page) {

        $parents = $this->getParentsRecursivly($page);

        foreach (array_reverse($parents) as $parent) {
            $this->addItem('static_page', array('ref' => $parent->getRef()), $parent->getTitle());
        }
        $this->addItem('static_page', array('ref' => $page->getRef()), $page->getTitle());

        return $this->getBreadcrumb();
    }

    public function getParentsRecursivly($page, $parents = array()) {
        if ($page->getParent()) {
            $parent = $page->getParent();
            $parents[] = $parent;
            return $this->getParentsRecursivly($parent, $parents);
        }
        return $parents;
    }

}
