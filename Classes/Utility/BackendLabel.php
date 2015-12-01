<?php

namespace BERGWERK\BwrkAddress\Utility;

use BERGWERK\BwrkAddress\Domain\Model\Address\Entry;
use BERGWERK\BwrkAddress\Domain\Repository\Address\EntryRepository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class BackendLabel
{
    public function entityType(&$parameters)
    {
        $uid = (int) $parameters['row']['uid'];

        /** @var Entry $entry */
        $entry = EntryRepository::create()->findByUid($uid);

        $typeConfiguration = $entry->getEntryTypeConfiguration();

        $parameters['title'] = $typeConfiguration['label'] . ': ' . $entry->getEntryValue();
    }
}