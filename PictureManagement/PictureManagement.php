<?php

namespace CTRLPlusN\Modules\PictureManagement\PictureManagement;

use Symfony\Component\DependencyInjection\ContainerInterface;

class PictureManagement {
    /**
     * ContainerInterface
     */
    protected $container;
    
    protected $menu;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
    
    
}
