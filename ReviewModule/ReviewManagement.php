<?php

namespace CTRLPlusN\Modules\ReviewModule;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CTRLPlusN\Modules\ReviewModule\Entity\Category;
use CTRLPlusN\Modules\ReviewModule\Entity\Post;

class ReviewModule {

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
