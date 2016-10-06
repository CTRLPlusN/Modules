<?php

namespace CTRLPlusN\Modules\SlideshowModule\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Slide
 */
class Slide {

    /**
     *
     * @JMS\Type("string")
     */
    protected $relativePath;

    public function getRelativePath() {
        return $this->relativePath;
    }

    public function setRelativePath($relativePath) {
        $this->relativePath = $relativePath;
    }

}
