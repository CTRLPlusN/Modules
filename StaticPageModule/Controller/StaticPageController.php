<?php

namespace CTRLPlusN\Modules\StaticPageModule\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use CTRLPlusN\Modules\StaticPageModule\Entity\Page;

/**
 * @Route("/")
 */
class StaticPageController extends Controller {

    /**
     * Need : Entity Page, breadcrumb service
     * option: $extras view parameters, $baseView name
     * @return view
     */
    private function loadRender(Page $page, $breadcrumb, $extras = array(), $baseView = 'AppBundle::page.html.twig') {
        $params = array(
            'title' => $page->getTitle(),
            'template' => $page->getView(),
            'breadcrumb' => $breadcrumb->getBreadcrumb(),
        );

        return $this->render($baseView, array_merge($params, $extras));
    }
    
    /**
     * Création d'une page
     * 1) En zone admin remplir au minium les 3 champs :
     *      - titre
     *      - référence
     *      - vue
     * 2) Ajouter dans le controller @route/{page.ref}
     * 3) Créer le breadcrumb
     */

    /**
     * @Route("/{ref}", name="static_page")
     */
    public function staticAction(Request $request, Page $page) {

        $breadcrumb = $this->get('component.breadcrumb');
        // route name, route paramters, page title
        $breadcrumb->addItem($request->get('_route'), array('ref' => $page->getRef()), $page->getTitle());

        return $this->loadRender($page, $breadcrumb);
    }

}
