<?php

namespace CTRLPlusN\Modules\StaticPageModule\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Gedmo\Tree\Traits\Repository\ORM\NestedTreeRepositoryTrait;
use CTRLPlusN\Extensions\Doctrine\Repository\TreeExtrasQueries;

/**
 * PageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PageRepository extends \Doctrine\ORM\EntityRepository {

    use NestedTreeRepositoryTrait,
        TreeExtrasQueries; // or MaterializedPathRepositoryTrait or ClosureTreeRepositoryTrait, NestedTreeRepositoryTrait.

    public function __construct(EntityManager $em, ClassMetadata $class) {
        parent::__construct($em, $class);

        $this->initializeTreeRepository($em, $class);
    }

}
