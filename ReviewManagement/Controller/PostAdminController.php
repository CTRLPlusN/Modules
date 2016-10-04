<?php

namespace CTRLPlusN\Libs\ReviewManagement\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use CTRLPlusN\Libs\ReviewManagement\Entity\Post;
use CTRLPlusN\Libs\ReviewManagement\Form\PostType;

/**
 * @Route("/post")
 * @Security("has_role('ROLE_ADMIN')")
 */
class PostAdminController extends Controller {

    /**
     * @Route("/", name="admin_post_index")
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository(Post::class)->findPosts();

        return $this->render('@review/post-index.html.twig', array(
                    'posts' => $posts
        ));
    }

    /**
     * @Route("/add", name="admin_post_add")
     * @Route("/edit/{id}", name="admin_post_edit")
     */
    public function editAction(Request $request, Post $post = null) {

        $user = $this->getUser();

        if (!$post) {
            $post = new Post();
        }

        $form = $this->createForm(PostType::class, $post, array('current_user' => $user));

        if ($form->handleRequest($request)->isValid()) {
            $this->container->get('function.doctrine.entity_process')->save($form);
            $this->addFlash('green', 'Données sauvegardées.');
            return $this->redirect($this->generateUrl('admin_post_edit', array(
                                'id' => $post->getId()
            )));
        }

        return $this->render('@review/post-edit.html.twig', array(
                    'form' => $form->createView(), 'post' => $post,
        ));
    }

    /**
     * @Route("/delete/{id}", name="admin_post_delete")
     */
    public function deleteAction(Post $entity) {
        $this->container->get('function.doctrine.entity_process')->delete($entity);
        return $this->redirect($this->generateUrl('admin_post_index'));
    }

}
