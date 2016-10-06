<?php

namespace CTRLPlusN\Modules\PictureModule\Controller\FrontTrait;

use CTRLPlusN\Modules\PictureModule\Entity\Album;

trait ShowAlbumActionTrait {

    /**
     * @Route("/{slug}", name="album_show")
     */
    public function showAlbumAction(Album $album = null) {

        return $this->render(self::TPL_SINGLE_ALBUM, array(
                    'album' => $album,
                    'title' => $album->getTitle(),
                    'images' => $album->getImages(),
                    'og' => $this->get('component.opengraph')->getArticleOg($album),
        ));
    }

}
