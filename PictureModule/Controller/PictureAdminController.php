<?php

namespace CTRLPlusN\Modules\PictureModule\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use CTRLPlusN\Modules\PictureModule\Entity\Album;
use CTRLPlusN\Modules\PictureModule\Form\AlbumType;
use CTRLPlusN\Modules\PictureModule\Entity\Image;
use CTRLPlusN\Modules\PictureModule\Form\ImageType;

/**
 * @Route("/picture")
 * @Security("has_role('ROLE_ADMIN')")
 */
class PictureAdminController extends Controller {

    /**
     * @Route("/album", name="admin_album_index")
     */
    public function indexAlbumAction() {

        $em = $this->getDoctrine()->getManager();

        $albums = $em->getRepository(Album::class)->findAll();

        return $this->render('@picture/admin-album-index.html.twig', array(
                    'albums' => $albums
        ));
    }

    /**
     * @Route("/albmu/add", name="admin_album_add")
     * @Route("/album/edit/{id}", name="admin_album_edit")
     */
    public function editAlbumAction(Request $request, Album $album = null) {

        if (!$album) {
            $album = new Album();
        }
        $form = $this->createForm(AlbumType::class, $album, array());

        if ($form->handleRequest($request)->isValid()) {
            $this->container->get('function.doctrine.entity_process')->save($form);
            $this->addFlash('green', 'Données sauvegardées.');
            return $this->redirect($this->generateUrl('admin_album_edit', array(
                                'id' => $album->getId()
            )));
        }

        return $this->render('@picture/admin-album-edit.html.twig', array(
                    'form' => $form->createView(), 'album' => $album, 'images' => $album->getImages()
        ));
    }

    /**
     * @Route("/album/delete/{id}", name="admin_album_delete")
     */
    public function deleteAlbumAction(Album $entity) {
        $this->container->get('function.doctrine.entity_process')->delete($entity);
        return $this->redirect($this->generateUrl('admin_album_index'));
    }

    /* Images */

    /**
     * @Route("/image", name="admin_image_index" )
     */
    public function indexImageAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $filter = trim($request->get('filter'));

        if ($filter === 'All' || $filter == null) {
            $images = $em->getRepository(Image::class)->findAll();
        } else {
            $images = $em->getRepository(Image::class)->findBy(array('album' => null));
        }

        return $this->render('@picture/admin-image-index.html.twig', array(
                    'images' => $images
        ));
    }

    /**
     * Ajout d'une image à partir d'un album
     * L'ajout d'image à partir de l'index n'est pas permis
     * @Route("/image/add/in-album-{id}", name="admin_image_add" )
     */
    public function addImageAction(Request $request, Album $album) {

        if (!$album) {
            return $this->redirect($this->generateUrl('admin_album_index'));
        }

        $image = new Image();
        $image->setAlbum($album);
        $form = $this->createForm(ImageType::class, $image);

        if ($form->handleRequest($request)->isValid()) {
            $this->container->get('function.doctrine.entity_process')->save($form);
            $this->addFlash('green', 'Données sauvegardées.');

            return $this->redirect($this->generateUrl('admin_album_edit', array(
                                'id' => $album->getId()
            )));
        }
        return $this->render('@picture/admin-image-edit.html.twig', array(
                    'form' => $form->createView(), 'image' => $image, 'album' => $album
        ));
    }

    /**
     * Edition d'une image
     * @Route("/image/edit/{id}", name="admin_image_edit")
     */
    public function editImageAction(Request $request, Image $image) {

        if (!$image) {
            return $this->redirect($this->generateUrl('admin_image_index'));
        }

        $form = $this->createForm(ImageType::class, $image);

        if ($form->handleRequest($request)->isValid()) {
            $this->container->get('function.doctrine.entity_process')->save($form);
            $this->addFlash('green', 'Données sauvegardées.');

            return $this->redirect($this->generateUrl('admin_image_edit', array(
                                'id' => $image->getId()
            )));
        }

        return $this->render('@picture/admin-image-edit.html.twig', array(
                    'form' => $form->createView(), 'image' => $image, 'album' => $image->getAlbum()
        ));
    }
    
    /**
     * @Route("/image/delete/{id}", name="admin_image_delete")
     */
    public function deleteImageAction(Image $image) {
        if($image->getAlbum()) {
            $album = $image->getAlbum();
            $redirect = $this->generateUrl('admin_album_edit', array('id' => $album->getId() ));
        } else {
            $redirect = $this->generateUrl('admin_image_index');
        }
        $this->container->get('function.doctrine.entity_process')->delete($image);
        return $this->redirect($redirect);
    }

}
