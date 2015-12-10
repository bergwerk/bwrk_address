<?php

namespace BERGWERK\BwrkAddress\Utility;

use BERGWERK\BwrkAddress\Domain\Model\Address\Entry;
use BERGWERK\BwrkAddress\Domain\Repository\Address\EntryRepository;

/**
 * Class BackendLabel
 * @package BERGWERK\BwrkAddress\Utility
 */
class BackendLabel
{
    /**
     * @param $parameters
     */
    public function entityType(&$parameters)
    {
        $uid = (int)$parameters['row']['uid'];

        /** @var Entry $entry */
        $entry = EntryRepository::create()->findByUid($uid);

        if (is_null($entry)) {
            $parameters['title'] = 'NEW';
        } else {
            $typeConfiguration = $entry->getEntryType();

            $parameters['title'] = $typeConfiguration->getLabel() . ': ' . $entry->getReadableValue();
        }

    }
}