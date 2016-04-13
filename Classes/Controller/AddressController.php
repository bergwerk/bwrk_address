<?php

namespace BERGWERK\BwrkAddress\Controller;

use BERGWERK\BwrkAddress\Domain\Repository\AddressRepository;
use BERGWERK\BwrkAddress\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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
        $categoryUids = $this->settings['categories'];

        $addresses = AddressRepository::create()->findWithCategories($categoryUids);
        $categories = CategoryRepository::create()->findByUids($categoryUids, 'title');

        $this->view->assign('addresses', $addresses);
        $this->view->assign('categories', $categories);
    }

    /**
     *
     */
    public function listManualAction()
    {
        $records = $this->settings['records'];

        $addresses = AddressRepository::create()->findByUids($records);

        $this->view->assign('addresses', $addresses);
    }

    /**
     *
     */
    public function singleAction()
    {
        $addressUid = (int) $this->settings['address'];

        $address = AddressRepository::create()->findByUid($addressUid);

        $this->view->assign('address', $address);
    }

    /**
     * @todo get address uid by url
     */
    public function detailAction()
    {
        $addressUid = (int) 1; // $this->settings['address'];

        $address = AddressRepository::create()->findByUid($addressUid);

        $this->view->assign('address', $address);
    }
}