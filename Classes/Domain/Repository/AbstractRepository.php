<?php

namespace BERGWERK\BwrkAddress\Domain\Repository;

use BERGWERK\BwrkAddress\Bootstrap;
use TYPO3\CMS\Extbase\Persistence\Repository;

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
}