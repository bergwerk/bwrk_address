<?php

namespace BERGWERK\BwrkAddress\ViewHelpers\Address;

use BERGWERK\BwrkAddress\ViewHelpers\AbstractViewHelper;

class EntryViewHelper extends AbstractViewHelper
{
    /**
     * @param \BERGWERK\BwrkAddress\Domain\Model\Address $address
     * @param string $entryType
     * @return string
     */
    public function render($address, $entryType)
    {
        return $address->getEntriesWithType($entryType);
    }
}