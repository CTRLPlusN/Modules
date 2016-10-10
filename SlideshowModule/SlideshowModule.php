<?php

namespace CTRLPlusN\Modules\SlideshowModule;

use CTRLPlusN\Extensions\FileSystem\FileSystemTools;
use CTRLPlusN\Modules\SlideshowModule\Model\Slideshow;

class SlideshowModule {

    /**
     * FileSystemTools
     */
    protected $fst;

    public function __construct() {
        $this->fst = FileSystemTools::create();
        $this->fst->setDir('../src/CTRLPlusN/Resources/json');
        $this->fst->setFilename('settings-slideshow.json');
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
