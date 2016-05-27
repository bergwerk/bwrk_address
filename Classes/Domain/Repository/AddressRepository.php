<?php

namespace BERGWERK\BwrkAddress\Domain\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 * Class AddressRepository
 * @package BERGWERK\BwrkAddress\Domain\Repository
 */
class AddressRepository extends AbstractRepository
{
    /**
     * @param $categories
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findWithCategories($categories)
    {
        $categoryUids = explode(',', $categories);

        $query = $this->createQuery();

        $query->matching(
            $query->in('categories.uid', $categoryUids)
        );

        $query->setOrderings(array(
            'sorting' => QueryInterface::ORDER_ASCENDING
        ));

        return $query->execute();
    }
}