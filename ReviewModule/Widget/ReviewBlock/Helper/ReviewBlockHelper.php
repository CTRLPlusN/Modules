<?php

namespace CTRLPlusN\Modules\ReviewModule\Widget\ReviewBlock\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;

class ReviewBlockHelper extends Helper {

    protected $templating;

    public function __construct(EngineInterface $templating) {
        $this->templating = $templating;
    }

    /**
     * @return html content
     */
    public function getBlockView($block, $datas, $view) {
       return $this->templating->render($view, array('block' => $block, 'datas' => $datas));
    }

    public function getName() {
        return 'reviewblock_helper';
    }

}
