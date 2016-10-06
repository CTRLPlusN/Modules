<?php

namespace CTRLPlusN\Modules\SlideshowModule;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SlideshowModule {

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

}
