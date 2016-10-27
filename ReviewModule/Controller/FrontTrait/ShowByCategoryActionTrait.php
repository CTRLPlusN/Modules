<?php

namespace CTRLPlusN\Modules\ReviewModule\Controller\FrontTrait;

use Symfony\Component\HttpFoundation\Request;
use CTRLPlusN\Modules\ReviewModule\Entity\Category;

trait ShowByCategoryActionTrait {

    /**
     * @Route("/category/{slug}/{num}", name="category_show", defaults={"num"=1}, requirements={"num" = "\d+"})
     */
    public function showByCategory(Request $request, $num, Category $category) {
        if (!$category) {
            return $this->redirect($this->generateUrl('homepage'));
        }

        $em = $this->getDoctrine()->getManager();

        $arr = array($category->getId());
        if ($category->getParent() == null) {
            foreach ($category->getChildren() as $child) {
                $arr[] = $child->getId();
            }
        }
        $parameters = array(
            'published' => true,
            'category' => $arr,
        );
        $posts = $this->container->get('module.review_module')->findAllPosts($num, 10, $parameters);

        return $this->render(self::TPL_SINGLE_CATEGORY, array(
                    'datas' => $posts,
                    'category' => $category,
                    'title' => $category->getTitle(),
                    'pagination' => $this->get('components.paginate')->getPagination($num, $posts, $request->get('_route'), array('slug' => $category->getSlug())),
                    'breadcrumb' => $this->get('review.widget.breadcrumb')->createBreadcrumb(array($category))
        ));
    }

}
