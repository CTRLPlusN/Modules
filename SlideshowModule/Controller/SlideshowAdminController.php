<?php

namespace CTRLPlusN\Modules\SlideshowModule\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use CTRLPlusN\Modules\SlideshowModule\Form\SlideshowType;
use CTRLPlusN\Modules\SlideshowModule\Model\Slideshow;

/**
 * @Route("/slideshow")
 * @Security("has_role('ROLE_ADMIN')")
 */
class SlideshowAdminController extends Controller {

    /**
     * @Route("/", name="admin_slideshow_index")
     */
    public function indexAction(Request $request) {

        $form = $this->createForm(SlideshowType::class, $this->get('module.slideshow_module')->loadConfiguration());

        if ($form->handleRequest($request)->isValid()) {
            $dataform = $form->getData(); // Object Slideshow
            $this->get('module.slideshow_module')->saveConfiguration($dataform);
            $this->addFlash('success', 'Données sauvegardées.');
            return $this->redirect($this->generateUrl('admin_slideshow_index'));
        }

        return $this->render('@slideshow/slideshow-admin-index.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

}
