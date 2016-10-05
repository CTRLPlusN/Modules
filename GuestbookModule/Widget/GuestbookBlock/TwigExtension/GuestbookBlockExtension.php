<?php

namespace CTRLPlusN\Modules\GuestbookModule\Widget\GuestbookBlock\TwigExtension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use CTRLPlusN\Modules\GuestbookModule\Entity\Message;
use CTRLPlusN\Modules\GuestbookModule\Form\MessageType;

class GuestbookBlockExtension extends \Twig_Extension {

    /**
     * ContainerInterface
     */
    protected $container;

    /**
     *  ObjectManager
     */
    protected $em;

    /**
     * RouterInterface
     */
    protected $router;

    public function __construct(ContainerInterface $container, ObjectManager $em, RouterInterface $router) {
        $this->container = $container;
        $this->em = $em;
        $this->router = $router;
    }

    public function getName() {
        return 'guestbook_block_extension';
    }

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('guestbook_form', array($this, 'getForm'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('guestbook_messages', array($this, 'getMessages'), array('is_safe' => array('html'))),
        );
    }

    public function getForm($current_url = null) {
        return $this->container->get('guestbook.widget.guestbook_block.helper')->renderForm($this->createForm($current_url));
    }

    public function getMessages($limit = 10) {
        return $this->container->get('guestbook.widget.guestbook_block.helper')->renderLoopMsg($this->loadMsg($limit));
    }

    public function createForm($current_url = null) {
        return $this->container->get('form.factory')->create(MessageType::class, new Message(), array(
                    'action' => $this->container->get('router')->generate('guestbook_form',  array('redirect' => $current_url)),
        ));
    }

    public function loadMsg($limit = null) {
        return $this->em->getRepository('Guestbook:Message')->findBy(array(), array('created' => 'DESC'), $limit);
    }

}
