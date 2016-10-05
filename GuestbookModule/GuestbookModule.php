<?php

namespace CTRLPlusN\Modules\GuestbookModule;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;

class GuestbookModule {

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
