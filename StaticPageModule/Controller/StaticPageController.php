<?php

namespace CTRLPlusN\Modules\StaticPageModule\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use CTRLPlusN\Modules\StaticPageModule\Entity\Page;

/**
 * @Route("/")
 */
class StaticPageController extends Controller {
    /**
     * Création d'une page
     * 1) En zone admin remplir au minium les 3 champs :
     *      - titre
     *      - référence
     *      - vue
     */

    /**
     * @Route("/{ref}", name="static_page")
     */
    public function staticAction(Page $page) {

        return $this->render('@app/page.html.twig', array(
                    'title' => $page->getTitle(),
                    'template' => $page->getView(),
                    'breadcrumb' => $this->get('staticpage.widget.breadcrumb')->createBreadcrumb($page),
        ));
    }

}
