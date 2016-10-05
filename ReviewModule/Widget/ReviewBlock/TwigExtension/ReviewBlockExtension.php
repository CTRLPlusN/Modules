<?php

namespace CTRLPlusN\Modules\ReviewModule\Widget\ReviewBlock\TwigExtension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ReviewBlockExtension extends \Twig_Extension {

    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * {{ ReviewBlock('block_name', parameters ) }}
     */
    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('ReviewBlock', array($this, 'getBlock'), array('is_safe' => array('html'))),
        );
    }

    public function getBlock($block, Array $parameters = null, $limit = 5) {
        $method = 'get' . ucfirst($block);
        if ($this->container->hasParameter('review.block.view.' . $block)) {
            $view = $this->container->getParameter('review.block.view.' . $block);
        } else {
            $view = '@review/block.html.twig';
        }
        return $this->container->get('review.widget.review_block.helper')->getBlockView($block, $this->$method($parameters, $limit), $view);
    }

    /**
     * {{ ReviewBlock('relatedposts', {'category' : Category.id}, limit} ) }}
     */
    public function getRelatedposts($parameters, $limit) {
        if ($parameters == null) {
            $parameters = array('category' => null);
        }
        return $this->container->get('review.widget.review_block')->findRelatedXPosts($parameters['category'], $limit);
    }

    /**
     * {{ ReviewBlock('lastposts', limit ) }}
     */
    protected function getLastposts($parameters, $limit) {
        return $this->container->get('review.widget.review_block')->findLastXPosts($limit);
    }

    public function getName() {
        return 'reviewblock_extension';
    }

}
