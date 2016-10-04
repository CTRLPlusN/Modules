<?php

namespace CTRLPlusN\Libs\ReviewManagement\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use CTRLPlusN\Libs\ReviewManagement\Entity\Category;
use CTRLPlusN\Libs\ReviewManagement\Form\CategoryType;

/**
 * @Route("/category")
 * @Security("has_role('ROLE_ADMIN')")
 */
class CategoryAdminController extends Controller {
    
    /**
     * @Route("/", name="admin_category_index")
     * @Route("/add", name="admin_category_add")
     * @Route("/edit/{id}", name="admin_category_edit")
     */
    public function editAction(Request $request, Category $category  = null) {

        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository(Category::class)->findAllAssociations();
        $data = array();

        // Retour un Array en ordre Category_parent -> Children
        foreach ($categories as $cat) {
            if ($cat->getParent() === null) {
                $data[] = $cat;
                foreach ($cat->getChildren() as $child) {
                    $data[] = $child;
                }
            }
        }

        if(!$category) {
            $category = new Category();
        }

        $form = $this->createForm(CategoryType::class, $category);

        if ($form->handleRequest($request)->isValid()) {
            $this->container->get('function.doctrine.entity_process')->save($form);
            $this->addFlash('green', 'Données sauvegardées.');
            return $this->redirect($this->generateUrl('admin_category_edit', array(
                                'id' => $category->getId(), 'categories' => $data,
            )));
        }

        return $this->render('@review/category-index.html.twig', array(
                    'form' => $form->createView(), 'category' => $category, 'categories' => $data,
        ));
    }

    /**
     * @Route("/delete/{id}", name="admin_category_delete")
     */
    public function deleteAction(Category $entity) {
        $this->container->get('function.doctrine.entity_process')->delete($entity);
        return $this->redirect($this->generateUrl('admin_category_index'));
    }

}