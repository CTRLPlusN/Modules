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
            new \Twig_SimpleFunction('relatedposts_block', array($this, 'getBlockRelatedPosts'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('lastposts_block', array($this, 'getBlockLastPosts'), array('is_safe' => array('html'))),
        );
    }

    public function getBlockRelatedPosts($parameters = array(), $limit = 5) {
        return $this->container->get('review.widget.review_block.helper')->getBlockView($this->getRelatedposts($parameters, $limit));
    }
    
    public function getBlockLastPosts($area, $limit = 5) {
        return $this->container->get('review.widget.review_block.helper')->getBlockLastPost($area, $this->getLastposts($limit));
    }

    public function getRelatedposts($parameters, $limit) {
        if ($parameters == null) {
            $parameters = array('category' => null);
        }
        return $this->container->get('review.widget.review_block')->findRelatedXPosts($parameters['category'], $limit);
    }

    protected function getLastposts($limit) {
        return $this->container->get('review.widget.review_block')->findLastXPosts($limit);
    }

    public function getName() {
        return 'reviewblock_extension';
    }

}
