<?php

namespace CTRLPlusN\Libs\ReviewManagement\Widget\ReviewBlock;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ReviewBlockWidget {

    /**
     * EntityManager
     */
    private $em;

    /**
     * ContainerInterface
     */
    protected $container;

    public function __construct(ObjectManager $em, ContainerInterface $container) {
        $this->em = $em;
        $this->container = $container;
    }

    public function findRelatedXPosts($category, $limit) {
        return $this->em->getRepository('Review:Post')->findBy(array('published' => true, 'category' => $category), array('created' => 'DESC'), $limit);
    }

    public function findLastXPosts($limit) {
        return $this->em->getRepository('Review:Post')->findBy(array('published' => true), array('created' => 'DESC'), $limit);
    }

}
