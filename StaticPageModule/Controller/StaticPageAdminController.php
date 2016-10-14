<?php

namespace CTRLPlusN\Modules\StaticPageModule\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use CTRLPlusN\Modules\StaticPageModule\Entity\Page;
use CTRLPlusN\Modules\StaticPageModule\Form\StaticPageType;

/**
 * @Route("/static_page")
 * @Security("has_role('ROLE_ADMIN')")
 */
class StaticPageAdminController extends Controller {

    protected $activate = true;

    /**
     * @Route("/", name="admin_staticpage_index")
     */
    public function indexPageAction() {

        $em = $this->getDoctrine()->getManager();

        $tree = $em->getRepository(Page::class)->childrenHierarchy();

        return $this->render('@staticpage/page-index.html.twig', array(
                    'tree' => $tree
        ));
    }

    /**
     * @Route("/add", name="admin_staticpage_add")
     * @Route("/edit/{id}", name="admin_staticpage_edit")
     */
    public function editPostAction(Request $request, Page $page = null) {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Page::class);

        if (!$page) {
            $page = new Page();
        }

        $form = $this->createForm(StaticPageType::class, $page);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($page);
            $em->flush();
            $page->setPath($repo->getPath($page));
            $em->persist($page);
            $em->flush();
            $this->addFlash('success', 'Données sauvegardées.');
            return $this->redirect($this->generateUrl('admin_staticpage_edit', array(
                                'id' => $page->getId()
            )));
        }

        return $this->render('@staticpage/page-edit.html.twig', array(
                    'form' => $form->createView(), 'page' => $page,
        ));
    }

    /**
     * @Route("/delete/node/{id}", name="admin_staticpage_delete")
     */
    public function removeNodeAction($id) {
        if ($id) {
            $em = $this->getDoctrine()->getManager();
            $repo = $em->getRepository(Page::class);

            $node = $repo->findOneById($id);
            // Supprime UN noeud
            $repo->removeFromTree($node);
            $em->clear();
        }
        return $this->redirect($this->generateUrl('admin_staticpage_index', array(
        )));
    }

}
