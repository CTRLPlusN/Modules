<?php

namespace CTRLPlusN\Libs\ReviewManagement\Controller\FrontTrait;

use CTRLPlusN\Libs\ReviewManagement\Entity\Post;
use CTRLPlusN\Libs\ReviewManagement\Entity\Category;

trait ReviewSitemapTrait {

    /**
     * @Route("/posts.{_format}", name = "_sitemap_posts", Requirements = {"_format" = "xml"})
     */
    public function sitemapPostAction() {
        $parameters = array(
            'entity' => Post::class,
            'criteria' => array('published' => true),
            'order' => array('created' => 'desc'),
            'route' => 'post_show',
            'route_params' => 'slug',
        );
        return $this->renderXmlAction($parameters, 'monthly');
    }

    /**
     * @Route("/categories.{_format}", name = "_sitemap_categories", Requirements = {"_format" = "xml"})
     */
    public function sitemapCategoryAction() {
        $parameters = array(
            'entity' => Category::class,
            'criteria' => array(),
            'order' => array('created' => 'desc'),
            'route' => 'category_show',
            'route_params' => 'slug',
        );
        return $this->renderXmlAction($parameters, 'weekly', 0.5);
    }

}
