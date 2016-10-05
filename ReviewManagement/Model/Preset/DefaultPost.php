<?php
namespace CTRLPlusN\Modules\ReviewManagement\Model\Preset;

use CTRLPlusN\Extensions\Entity\PropsTrait\AuthorTrait;
use CTRLPlusN\Extensions\Entity\PropsTrait\ExcerptTrait;
use CTRLPlusN\Extensions\Entity\PropsTrait\EntityTrait;
use CTRLPlusN\Modules\ReviewManagement\Traits\ManyToOneCategoryTrait;

trait DefaultPost {
    use EntityTrait, ExcerptTrait, AuthorTrait, ManyToOneCategoryTrait;
}
