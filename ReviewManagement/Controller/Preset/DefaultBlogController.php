<?php

namespace CTRLPlusN\Modules\ReviewManagement\Controller\Preset;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CTRLPlusN\Modules\ReviewManagement\Controller\FrontTrait\TemplateNameInterface;
use CTRLPlusN\Modules\ReviewManagement\Controller\FrontTrait\IndexPostActionTrait;
use CTRLPlusN\Modules\ReviewManagement\Controller\FrontTrait\ShowPostActionTrait;
use CTRLPlusN\Modules\ReviewManagement\Controller\FrontTrait\ShowByCategoryActionTrait;
use CTRLPlusN\Modules\ReviewManagement\Controller\FrontTrait\ResearchPostActionTrait;

class DefaultBlogController extends Controller implements TemplateNameInterface {

    use IndexPostActionTrait,
        ShowPostActionTrait,
        ShowByCategoryActionTrait,
        ResearchPostActionTrait;
}
