<?php

namespace CTRLPlusN\Modules\ReviewModule\Controller\FrontTrait;


use CTRLPlusN\Modules\ReviewModule\Entity\Post;
use CTRLPlusN\Modules\ReviewModule\Entity\Category;

trait SitemapReviewTrait {

    /**
     * @Route("/posts.{_format}", name = "_sitemap_posts", Requirements = {"_format" = "xml"})
     */
    public function sitemapPostAction() {

        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository(Post::class)->findBy(array('published' => true), array('created' => 'desc'));

        foreach ($posts as $post) {
            $urls[] = $this->getUrlsFormated('post_show', array('slug' => $post->getSlug()), $post->getUpdated(), 'monthly', 0.8);
        }

        return $this->renderXML(array('urls' => $urls));
    }

    /**
     * @Route("/categories.{_format}", name = "_sitemap_categories", Requirements = {"_format" = "xml"})
     */
    public function sitemapCategoryAction() {
        $em = $this->getDoctrine()->getManager();
        $categries = $em->getRepository(Category::class)->findBy(array(), array('created' => 'desc'));

        foreach ($categries as $category) {
            $urls[] = $this->getUrlsFormated('category_show', array('slug' => $category->getSlug()), $category->getUpdated(), 'weekly', 0.5);
        }

        return $this->renderXML(array('urls' => $urls));
    }

}
