<?php

namespace CTRLPlusN\Modules\SlideshowModule\Model;

use JMS\Serializer\Annotation as JMS;
use Doctrine\Common\Collections\ArrayCollection;
use CTRLPlusN\Modules\SlideshowModule\Model\Slide;

/**
 * Slideshow
 */
class Slideshow {

    /**
     *
     * @JMS\Type("string")
     */
    protected $id;

    /**
     *
     * @JMS\Type("ArrayCollection<CTRLPlusN\Modules\SlideshowModule\Model\Slide>")
     */
    protected $slides;

    public function __construct() {
        $this->slides = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getSlides() {
        return $this->slides;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function addSlide(Slide $slide) {
        $this->slides->add($slide);
        return $this;
    }

    public function removeSlide(Slide $slide) {
        $this->slides->removeElement($slide);
    }

}
