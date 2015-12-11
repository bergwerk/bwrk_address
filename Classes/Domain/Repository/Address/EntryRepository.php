<?php

namespace BERGWERK\BwrkAddress\Domain\Repository\Address;

use BERGWERK\BwrkAddress\Domain\Model\Address;
use BERGWERK\BwrkAddress\Domain\Repository\AbstractRepository;

/**
 * Class EntryRepository
 * @package BERGWERK\BwrkAddress\Domain\Repository\Address
 */
class EntryRepository extends AbstractRepository
{
    /**
     * @param Address $address
     * @param string $entryType
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByAddressAndType($address, $entryType)
    {
        $query = $this->createQuery();

        $query->matching(
            $query->logicalAnd(
                array(
                    $query->equals('address', $address->getUid()),
                    $query->equals('entryType', $entryType)
                )
            )
        );

        return $query->execute();
    }
}