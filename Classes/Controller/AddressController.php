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
        $entry = EntryRepository::create()->findAll();

        DebuggerUtility::var_dump($entry);
    }

    public function singleAction()
    {

    }
}