<?php

namespace CTRLPlusN\Modules\PictureModule\Controller\FrontTrait;

trait IndexAlbumActionTrait {

    /**
     * Index des albums
     * @Route("/", name="album_index")
     */
    public function indexAlbumAction() {

        $em = $this->getDoctrine()->getManager();

        $albums = $em->getRepository('Picture:Album')->findAll();

        return $this->render(self::TPL_INDEX_ALBUM, array(
                    'albums' => $albums, 'title' => 'Albums photos',
        ));
    }

}
