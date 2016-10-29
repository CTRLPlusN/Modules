<?php

namespace CTRLPlusN\Modules\ReviewModule\Widget\ReviewBlock;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Collections\ArrayCollection;

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

    public function findCategories() {
        $parents = $this->em->getRepository('Review:Category')->findAllAssociations(array(), array('created' => 'DESC'));
        $categories = new ArrayCollection();
        foreach ($parents as $parent) {
            if ($parent->getParent() === null) {
                $categories->add($parent);
                foreach ($parent->getChildren() as $child) {
                    $categories->add($child);
                }
            }
        }
        return $categories;
    }

}
