<?php

namespace CTRLPlusN\Libs\ReviewManagement\Repository;

use CTRLPlusN\Extensions\Doctrine\Repository\AdvancedEntityRepository;

class PostRepository extends AdvancedEntityRepository {

    public function findPosts($page = null, $limit = 10, $where = array(), $order = array('sortBy' => 'created', 'sortDir' => 'DESC')) {
        $this->createQB();

        $this->leftJoinLoop();

        // Condition WHERE
        $this->whereCondition($where);

        // Condition ORDER
        $this->orderCondition($order);

        if ($page) {
            return $this->paginate($page, $limit);
        }
        return $this->qb->getQuery()->getResult();
    }

    public function researchInPosts($string, $page = null, $limit = 10) {
        $this->createQB();

        if ($this->meta->fieldMappings['published']) {
            $this->whereCondition(array('published' => true));
        }

        $keys = array('title', 'content');
        foreach ($keys as $key) {
            if ($this->meta->fieldMappings[$key]) {
                $this->qb->orWhere($this->class . '.' . $key . ' LIKE :string');
            }
        }
        $this->qb->setParameter('string', '%' . $string . '%');

        $this->orderCondition(array('sortBy' => 'created', 'sortDir' => 'DESC'));

        if ($page) {
            return $this->paginate($page, $limit);
        }

        return $this->qb->getQuery()->getResult();
    }

}
