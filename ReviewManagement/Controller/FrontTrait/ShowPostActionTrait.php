<?php

namespace CTRLPlusN\Libs\ReviewManagement\Controller\FrontTrait;

use CTRLPlusN\Libs\ReviewManagement\Entity\Post;

trait ShowPostActionTrait {

    /**
     * @Route("/post/{slug}", name="post_show")
     */
    public function showPostAction(Post $post = null) {

        return $this->render( self::TPL_SINGLE_POST , array(
                    'post' => $post,
                    'title' => $post->getTitle(),
                    'category' => $post->getCategory(),
                    'og' => $this->get('component.opengraph')->getArticleOg($post),
                    'breadcrumb' => $this->get('review.widget.breadcrumb')->createBreadcrumb(array($post->getCategory(), $post))
        ));
    }

}
