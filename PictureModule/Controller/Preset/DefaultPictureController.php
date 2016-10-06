<?php

namespace CTRLPlusN\Modules\PictureModule\Controller\Preset;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CTRLPlusN\Modules\PictureModule\Controller\FrontTrait\TemplateNameInterface;
use CTRLPlusN\Modules\PictureModule\Controller\FrontTrait\IndexAlbumActionTrait;
use CTRLPlusN\Modules\PictureModule\Controller\FrontTrait\ShowAlbumActionTrait;

class DefaultPictureController extends Controller implements TemplateNameInterface {

    use IndexAlbumActionTrait,
        ShowAlbumActionTrait;
}
