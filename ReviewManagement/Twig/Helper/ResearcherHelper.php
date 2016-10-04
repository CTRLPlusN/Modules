<?php

namespace CTRLPlusN\Libs\ReviewManagement\Twig\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;

class ResearcherHelper extends Helper {

    protected $templating;

    public function __construct(EngineInterface $templating) {
        $this->templating = $templating;
    }

    /**
     * @return html content
     */
    public function view($form) {
        return $this->templating->render('@review/researcher-form.html.twig', array('form' => $form->createView()));
    }

    public function getName() {
        return 'researcher_helper';
    }

}
