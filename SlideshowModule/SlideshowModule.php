<?php

namespace CTRLPlusN\Modules\SlideshowModule;

use Symfony\Component\DependencyInjection\ContainerInterface;
use CTRLPlusN\Extensions\FileSystem\FileSystemTools;
use CTRLPlusN\Modules\SlideshowModule\Model\Slideshow;

class SlideshowModule {

    const FILE = 'settings-slideshow.json';
    const LOC_PATH = "@CTRLPlusN/Resources/json";

    /**
     * ContainerInterface
     */
    protected $container;
    
    /**
     * FileSystemTools
     */
    protected $fst;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->fst = FileSystemTools::create();
        $this->fst->setRelativePath('../src/CTRLPlusN/Resources/json', 'settings-slideshow.json');
    }

    public function loadConfiguration() {
        if(false === $this->fst->loadJsonData(Slideshow::class)) {
            return new Slideshow();
        }
        return $this->fst->getDatas();
    }

    public function saveConfiguration($dataform) {
        return $this->fst->saveJsonData($dataform);
    }

}
