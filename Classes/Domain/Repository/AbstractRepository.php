<?php

namespace BERGWERK\BwrkAddress\Domain\Repository;

use BERGWERK\BwrkAddress\Bootstrap;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class AbstractRepository
 * @package BERGWERK\BwrkAddress\Domain\Repository
 */
class AbstractRepository extends Repository
{
    /**
     * @return static
     */
    static public function create()
    {
        return Bootstrap::getObjectManager()->get(
            get_called_class()
        );
    }

    /**
     *
     */
    public function initializeObject()
    {

    }

    /**
     * @param $records string
     * @param string $sortField
     * @param string $sortOrder
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByUids($records, $sortField = null, $sortOrder = QueryInterface::ORDER_ASCENDING)
    {
        $uids = explode(',', $records);

        if (empty($sortField)) {
            $objects = array();

            foreach ($uids as $uid) {
                $object = $this->findByUid($uid);

                if (!is_null($object)) {
                    $objects[] = $object;
                }
            }

            return $objects;
        }

        $query = $this->createQuery();

        $query->matching(
            $query->in('uid', $uids)
        );

        $query->setOrderings(array(
            $sortField => $sortOrder
        ));

        return $query->execute();
    }
}