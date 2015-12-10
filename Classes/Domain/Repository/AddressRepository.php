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
        $categoryObjects = CategoryRepository::create()->findByUids($categoryUids);

        DebuggerUtility::var_dump($categoryObjects);

        $query = $this->createQuery();

        $query->matching(
            $query->in('categories', $categoryObjects)
        );

        return $query->execute();
    }
}