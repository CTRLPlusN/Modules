<?php

namespace CTRLPlusN\Modules\ReviewManagement\Controller\FrontTrait;

use Symfony\Component\HttpFoundation\Request;

trait IndexPostActionTrait {

    /**
     * Index des articles
     * @Route("/{num}", name="post_index" , defaults={"num"=1}, requirements={"num" = "\d+"})
     */
    public function indexPostAction(Request $request, $num) {

        $posts = $this->container->get('module.review_management')->findAllPosts($num);

        return $this->render(self::TPL_INDEX, array(
                    'datas' => $posts,
                    'title' => 'Blog',
                    'pagination' => $this->get('components.paginate')->getPagination($num, $posts, $request->get('_route')),
                    'breadcrumb' => $this->get('review.widget.breadcrumb')->createBreadcrumb(),
        ));
    }

}
