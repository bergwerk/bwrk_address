<?php

namespace BERGWERK\BwrkAddress\ViewHelpers\Address;

use BERGWERK\BwrkAddress\ViewHelpers\AbstractViewHelper;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class EntryViewHelper extends AbstractViewHelper
{
    /**
     * @param \BERGWERK\BwrkAddress\Domain\Model\Address $address
     * @param string $entryType
     * @return string
     */
    public function render($address, $entryType)
    {
        if($entryType == 'image')
        {
            $falImages = $address->getEntriesWithType('image')->getFirst()->getEntryFalImages();
            $i=0;
            foreach($falImages as $falImage)
            {
                if($i > 0) break;
                return $falImage->getUid();
                $i++;
            }
        } else {
            return $address->getEntriesWithType($entryType)->getFirst()->getEntryValue();
        }
    }
}