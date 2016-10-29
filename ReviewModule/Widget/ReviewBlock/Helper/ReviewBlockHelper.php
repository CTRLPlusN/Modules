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
    public function getBlockView($datas) {
        return $this->templating->render('@review/block.html.twig', array('block' => 'relatedposts', 'datas' => $datas));
    }

    /**
     * @return html content
     */
    public function getBlockLastPost($area, $datas) {
        return $this->templating->render('@review/block.html.twig', array('block' => 'lastposts', 'area' => $area, 'datas' => $datas));
    }
    
    /**
     * @return html content
     */
    public function getBlockCategories($view, $datas) {
        return $this->templating->render($view, array('block' => 'categories', 'datas' => $datas));
    }

    public function getName() {
        return 'reviewblock_helper';
    }

}
