<?php

namespace BERGWERK\BwrkAddress\Controller;

use BERGWERK\BwrkAddress\Domain\Repository\AddressRepository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class AddressController extends AbstractController
{
    public function listAction()
    {
        $addresses = AddressRepository::create()->findAll();

        DebuggerUtility::var_dump($addresses);
    }

    public function singleAction()
    {

    }
}