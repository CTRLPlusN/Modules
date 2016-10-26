<?php

namespace CTRLPlusN\Modules\SubscriberModule\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use CTRLPlusN\Modules\SubscriberModule\Entity\Subscriber;
use CTRLPlusN\Modules\SubscriberModule\Form\SubscriberType;

/**
 * @Route("/subscriber")
 * @Security("has_role('ROLE_ADMIN')")
 */
class SubscriberAdminController extends Controller {

    /**
     * @Route("/", name="admin_subscriber_index")
     */
    public function indexAction() {
        $form = $this->createForm(SubscriberType::class, new Subscriber());
        
        return $this->render('@subscriber/subscriber-admin-index.html.twig', array('form' => $form->createView()
        ));
    }

}
