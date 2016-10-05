<?php

namespace CTRLPlusN\Modules\ReviewManagement\Widget\Breadcrumb;

use CTRLPlusN\Components\Breadcrumb\Breadcrumb;
use CTRLPlusN\Modules\ReviewManagement\Entity\Post;
use CTRLPlusN\Modules\ReviewManagement\Entity\Category;

class BreadcrumbWidget extends Breadcrumb {

    public function createBreadcrumb(Array $datas = null) {
        $this->addItem('post_index', array(), 'Blog');

        if ($datas) {
            foreach ($datas as $data) {
                if ('research' === $data) {
                    $this->addItem('post_research_index', array(), 'Recherche');
                }
                if (is_object($data)) {
                    if (Category::class === get_class($data)) {
                        if ($data->getParent()) {
                            $this->addItem('category_show', array(
                                'slug' => $data->getParent()->getSlug()), $data->getParent()->getTitle()
                            );
                        }
                        $this->addItem('category_show', array('slug' => $data->getSlug()), $data->getTitle());
                    }
                    if (Post::class === get_class($data)) {
                        $this->addItem('post_show', array('slug' => $data->getSlug()), $data->getTitle());
                    }
                }
            }
        }
        return $this->getBreadcrumb();
    }

}
