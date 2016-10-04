<?php

namespace CTRLPlusN\Libs\LinkManagement\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use CTRLPlusN\Libs\LinkManagement\Entity\Link;
use CTRLPlusN\Libs\LinkManagement\Form\LinkType;

/**
 * @Route("/link")
 * @Security("has_role('ROLE_ADMIN')")
 */
class LinkAdminController extends Controller {
    
    /**
     * @Route("/", name="admin_link_index")
     * @Route("/add", name="admin_link_add")
     * @Route("/edit/{id}", name="admin_link_edit")
     */
    public function editAction(Request $request, Link $link  = null) {

        $em = $this->getDoctrine()->getManager();

        $links = $em->getRepository(Link::class)->findAll();


        if(!$link) {
            $link = new Link();
        }

        $form = $this->createForm(LinkType::class, $link);

        if ($form->handleRequest($request)->isValid()) {
            $this->container->get('function.doctrine.entity_process')->save($form);
            $this->addFlash('green', 'Données sauvegardées.');
            return $this->redirect($this->generateUrl('admin_link_edit', array(
                                'id' => $link->getId()
            )));
        }

        return $this->render('@link/link-admin-index.html.twig', array(
                    'form' => $form->createView(), 'links' => $links
        ));
    }

    /**
     * @Route("/delete/{id}", name="admin_link_delete")
     */
    public function deleteAction(Link $entity) {
        $this->container->get('function.doctrine.entity_process')->delete($entity);
        return $this->redirect($this->generateUrl('admin_link_index'));
    }

}