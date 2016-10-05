<?php

namespace CTRLPlusN\Modules\ReviewModule\Controller\Preset;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CTRLPlusN\Modules\ReviewModule\Controller\FrontTrait\TemplateNameInterface;
use CTRLPlusN\Modules\ReviewModule\Controller\FrontTrait\IndexPostActionTrait;
use CTRLPlusN\Modules\ReviewModule\Controller\FrontTrait\ShowPostActionTrait;
use CTRLPlusN\Modules\ReviewModule\Controller\FrontTrait\ShowByCategoryActionTrait;
use CTRLPlusN\Modules\ReviewModule\Controller\FrontTrait\ResearchPostActionTrait;

class DefaultBlogController extends Controller implements TemplateNameInterface {

    use IndexPostActionTrait,
        ShowPostActionTrait,
        ShowByCategoryActionTrait,
        ResearchPostActionTrait;
}
