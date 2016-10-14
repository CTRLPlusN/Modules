<?php

namespace CTRLPlusN\Modules\PictureModule\Controller\FrontTrait;

use CTRLPlusN\Modules\PictureModule\Entity\Album;

trait SitemapPictureTrait {

    /**
     * @Route("/albums.{_format}", name = "_sitemap_albums", Requirements = {"_format" = "xml"})
     */
    public function sitemapPostAction() {

        $em = $this->getDoctrine()->getManager();
        $albums = $em->getRepository(Album::class)->findBy(array(), array('created' => 'desc'));

        foreach ($albums as $album) {
            $urls[] = $this->getUrlsFormated('album_show', array('slug' => $album->getSlug()), $album->getUpdated(), 'monthly', 0.8);
        }

        return $this->renderXML(array('urls' => $urls));
    }

}
