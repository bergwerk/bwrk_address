<?php

namespace BERGWERK\BwrkAddress\Controller;

use BERGWERK\BwrkAddress\Domain\Model\Address\Entry;
use BERGWERK\BwrkAddress\Domain\Repository\Address\EntryRepository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class AddressController extends AbstractController
{
    public function listAction()
    {
        /** @var Entry $entry */
        $entry = EntryRepository::create()->findByUid(2);

        DebuggerUtility::var_dump(array(
            'rte' => $entry->getIsRte(),
            'images' => $entry->getIsImages(),
            'files' => $entry->getIsFiles()
        ));
    }

    public function singleAction()
    {

    }
}