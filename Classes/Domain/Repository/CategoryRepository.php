<?php

namespace BERGWERK\BwrkAddress\Domain\Repository;

class CategoryRepository extends AbstractRepository
{
    public function findByUids($categoryUids)
    {
        $query = $this->createQuery();

        $query->matching(
            $query->in('uid', $categoryUids)
        );

        return $query->execute();
    }
}