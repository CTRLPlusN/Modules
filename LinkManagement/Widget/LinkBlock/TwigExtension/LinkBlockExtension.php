<?php

namespace CTRLPlusN\Libs\LinkManagement\Widget\LinkBlock\TwigExtension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class LinkBlockExtension extends \Twig_Extension {

    /**
     * ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function getName() {
        return 'linkblock_extension';
    }

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('LinkBlock', array($this, 'getBlockHelper'), array('is_safe' => array('html'))),
        );
    }

    public function getBlockHelper() {
        return $this->container->get('link.widget.link_block.helper')->render($this->container->get('lib.link_management')->getLinks());
    }

}
