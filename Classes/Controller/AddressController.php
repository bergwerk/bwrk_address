<?php

namespace BERGWERK\BwrkAddress\Controller;

use BERGWERK\BwrkAddress\Domain\Model\Address\Entry;
use BERGWERK\BwrkAddress\Domain\Repository\Address\EntryRepository;
use BERGWERK\BwrkAddress\Domain\Repository\AddressRepository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\Category\Collection\CategoryCollection;

/**
 * Class AddressController
 * @package BERGWERK\BwrkAddress\Controller
 */
class AddressController extends AbstractController
{
    /**
     *
     */
    public function listAction()
    {
        $categories = $this->settings['categories'];

        $addresses = AddressRepository::create()->findWithCategories($categories);

        $this->view->assign('addresses', $addresses);
    }

    /**
     *
     */
    public function singleAction()
    {

    }
}