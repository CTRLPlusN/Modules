<?php

namespace CTRLPlusN\Modules\PictureModule\PictureModule;

use Symfony\Component\DependencyInjection\ContainerInterface;

class PictureModule {
    /**
     * ContainerInterface
     */
    protected $container;
    
    protected $menu;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
    
    
}
