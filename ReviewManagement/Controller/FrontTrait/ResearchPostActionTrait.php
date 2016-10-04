<?php

namespace CTRLPlusN\Libs\ReviewManagement\Controller\FrontTrait;

use Symfony\Component\HttpFoundation\Request;
use CTRLPlusN\Libs\ReviewManagement\Form\ResearchType;

trait ResearchPostActionTrait {

    /**
     * traitement de la recherche et affichage des résultats
     * @Route("/search/{num}", name="post_research_index" , defaults={"num"=1}, requirements={"num" = "\d+"})
     */
    public function searchPostAction(Request $request, $num) {

        $form = $this->createForm(ResearchType::class, null);
        if ($form->handleRequest($request)->isValid()) {
            $entry = $form->getData();
            $posts = $this->get('lib.researcher.ext')->getResults($entry['string'], $num);
        }

        return $this->render(self::TPL_RESEARCH, array(
                    'datas' => $posts,
                    'title' => 'Recherche',
                    'pagination' => $this->get('components.paginate')->getPagination($num, $posts, $request->get('_route')),
                    'breadcrumb' => $this->get('review.widget.breadcrumb')->createBreadcrumb(array('research')),
        ));
    }

}
