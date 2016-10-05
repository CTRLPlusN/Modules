<?php

namespace CTRLPlusN\Modules\ReviewModule\Repository;

use CTRLPlusN\Extensions\Doctrine\Repository\AdvancedEntityRepository;

class CategoryRepository extends AdvancedEntityRepository {

    /**
     * Affiche les catégories pouvant être parent
     * @param type Category $category
     * @return querybuilder
     */
    public function selectMainCategories($category) {
        
        $qb = $this->createQueryBuilder('c');
        $qb->where('c.parent is NULL');

        if ($category->getId()) {
            // Exclusion de sa propre ID
            $qb->andWhere('c.id != :id')
                    ->setParameter('id', $category->getId());
        }
        $qb->orderBy('c.title', 'ASC');
        return $qb;
    }

}
