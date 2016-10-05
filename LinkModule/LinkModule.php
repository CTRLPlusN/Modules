<?php

namespace CTRLPlusN\Modules\LinkModule;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LinkModule {

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

    public function getLinks($limit = null) {
        return $this->em->getRepository('Link:Link')->findBy(array(), array('created' => 'DESC'), $limit);
    }

}
