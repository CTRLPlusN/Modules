<?php
namespace CTRLPlusN\Modules\ReviewModule\Model\Preset;

use CTRLPlusN\Extensions\Entity\PropsTrait\AuthorTrait;
use CTRLPlusN\Extensions\Entity\PropsTrait\ExcerptTrait;
use CTRLPlusN\Extensions\Entity\PropsTrait\EntityTrait;
use CTRLPlusN\Modules\ReviewModule\Traits\ManyToOneCategoryTrait;

trait DefaultPost {
    use EntityTrait, ExcerptTrait, AuthorTrait, ManyToOneCategoryTrait;
}
