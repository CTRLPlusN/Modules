<?php

namespace CTRLPlusN\Modules\GuestbookModule\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/guestbook")
 */
class GuestbookFrontController extends Controller {

    /**
     * @Route("/form", name="guestbook_form")
     */
    public function formAction(Request $request) {
        $form = $this->container->get('guestbook.widget.guestbook_block.ext')->createForm();
        if ($form->handleRequest($request)->isValid()) {
            $this->container->get('function.doctrine.entity_process')->save($form);
        }
        return $this->redirect($request->get('redirect'), 302);
    }

}
