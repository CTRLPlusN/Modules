<?php

namespace CTRLPlusN\Modules\ReviewManagement;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CTRLPlusN\Modules\ReviewManagement\Entity\Category;
use CTRLPlusN\Modules\ReviewManagement\Entity\Post;

class ReviewManagement {

    /**
     * ContainerInterface
     */
    protected $container;

    /**
     * ObjectManager
     */
    protected $em;

    public function __construct(ContainerInterface $container, ObjectManager $em) {
        $this->container = $container;
        $this->em = $em;
    }

    public function findAllPosts($page = 1, $limit = 10, $where = array('published' => true), Array $order = array('sortBy' => 'created', 'sortDir' => 'DESC')) {
        return $this->em->getRepository(Post::class)->findPosts($page, $limit, $where, $order);
    }

}
