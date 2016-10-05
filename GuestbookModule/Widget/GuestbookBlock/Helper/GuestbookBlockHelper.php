<?php

namespace CTRLPlusN\Modules\GuestbookModule\Widget\GuestbookBlock\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;

class GuestbookBlockHelper extends Helper {

    protected $templating;

    public function __construct(EngineInterface $templating) {
        $this->templating = $templating;
    }

    public function renderForm($form) {
        return $this->templating->render('@guestbook/guestbook-message-form.html.twig', array('form' => $form->createView()));
    }
    
      public function renderLoopMsg($messages) {
        return $this->templating->render('@guestbook/guestbook-message-loop.html.twig', array('messages' => $messages));
    }

    public function getName() {
        return 'guestbook_block_helper';
    }

}
