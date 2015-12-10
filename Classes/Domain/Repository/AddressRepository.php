<?php

namespace BERGWERK\BwrkAddress\Domain\Repository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class AddressRepository
 * @package BERGWERK\BwrkAddress\Domain\Repository
 */
class AddressRepository extends AbstractRepository
{
    public function findWithCategories($categories)
    {
        $categoryUids = explode(',', $categories);

        $query = $this->createQuery();

        $query->matching(
            $query->in('categories.uid', $categoryUids)
        );

        return $query->execute();
    }
}