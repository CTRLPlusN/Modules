<?php

namespace CTRLPlusN\Modules\GuestbookModule\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use CTRLPlusN\Modules\GuestbookModule\Entity\Message;


/**
 * @Route("/guestbook")
 * @Security("has_role('ROLE_ADMIN')")
 */
class GuestbookAdminController extends Controller {

    /**
     * @Route("/", name="admin_guestbook_index")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository(Message::class)->findAll();

        return $this->render('@guestbook/guestbook-admin-index.html.twig', array(
                    'messages' => $messages
        ));
    }

    /**
     * @Route("/delete/{id}", name="admin_guestbook_delete")
     */
    public function deleteAction(Message $entity) {
        $this->container->get('function.doctrine.entity_process')->delete($entity);
        return $this->redirect($this->generateUrl('admin_guestbook_index'));
    }

}
