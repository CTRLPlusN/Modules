<?php

namespace CTRLPlusN\Libs\ReviewManagement\Controller\Preset;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CTRLPlusN\Libs\ReviewManagement\Controller\FrontTrait\TemplateNameInterface;
use CTRLPlusN\Libs\ReviewManagement\Controller\FrontTrait\IndexPostActionTrait;
use CTRLPlusN\Libs\ReviewManagement\Controller\FrontTrait\ShowPostActionTrait;
use CTRLPlusN\Libs\ReviewManagement\Controller\FrontTrait\ShowByCategoryActionTrait;
use CTRLPlusN\Libs\ReviewManagement\Controller\FrontTrait\ResearchPostActionTrait;

class DefaultBlogController extends Controller implements TemplateNameInterface {

    use IndexPostActionTrait,
        ShowPostActionTrait,
        ShowByCategoryActionTrait,
        ResearchPostActionTrait;
}
