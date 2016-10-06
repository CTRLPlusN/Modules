<?php

namespace CTRLPlusN\Modules\SlideshowModule\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/slideshow")
 * @Security("has_role('ROLE_ADMIN')")
 */
class SlideshowAdminController extends Controller {
    
    /**
     * @Route("/", name="admin_slideshow_index")
     */
    public function indexAction() {

        return $this->render('@slideshow/slideshow-admin-index.html.twig', array(
        ));
    }

}