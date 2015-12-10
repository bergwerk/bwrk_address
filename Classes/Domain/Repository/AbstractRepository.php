<?php

namespace BERGWERK\BwrkAddress\Domain\Repository;

use BERGWERK\BwrkAddress\Bootstrap;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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

    public function initializeObject()
    {
        $defaultQuerySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');

        $defaultQuerySettings->setRespectStoragePage(false);

        $this->setDefaultQuerySettings($defaultQuerySettings);
    }
}