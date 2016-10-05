<?php

namespace CTRLPlusN\Modules\LinkModule\Widget\LinkBlock\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;

class LinkBlockHelper extends Helper {

    protected $templating;

    public function __construct(EngineInterface $templating) {
        $this->templating = $templating;
    }

    public function render($links) {
        return $this->templating->render('@link/link-block.html.twig', array('links' => $links));
    }

    public function getName() {
        return 'linkblock_helper';
    }

}
