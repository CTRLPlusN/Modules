<?php
namespace CTRLPlusN\Libs\ReviewManagement\Model\Preset;

use CTRLPlusN\Extensions\Entity\PropsTrait\AuthorTrait;
use CTRLPlusN\Extensions\Entity\PropsTrait\ExcerptTrait;
use CTRLPlusN\Extensions\Entity\PropsTrait\EntityTrait;
use CTRLPlusN\Libs\ReviewManagement\Traits\ManyToOneCategoryTrait;

trait DefaultPost {
    use EntityTrait, ExcerptTrait, AuthorTrait, ManyToOneCategoryTrait;
}
