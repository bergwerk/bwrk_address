<?php

namespace BERGWERK\BwrkAddress\Domain\Repository;

/**
 * Class AddressRepository
 * @package BERGWERK\BwrkAddress\Domain\Repository
 */
class AddressRepository extends AbstractRepository
{
    /**
     * @param $categories string
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findWithCategories($categories)
    {
        $categoryUids = explode(',', $categories);

        $query = $this->createQuery();

        $query->matching(
            $query->in('categories.uid', $categoryUids)
        );

        return $query->execute();
    }

    /**
     * @param $records string
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByUids($records)
    {
        $uids = explode(',', $records);

        $objects = array();

        foreach ($uids as $uid) 
        {
            $object = $this->findByUid($uid);

            if (!is_null($object))
            {
                $objects[] = $object;
            }
        }

        return $objects;
    }
}