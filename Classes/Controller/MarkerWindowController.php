<?php
namespace BERGWERK\BwrkAddress\Controller;

use BERGWERK\BwrkAddress\Domain\Repository\AddressRepository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extensionmanager\Controller\ActionController;

class MarkerWindowController extends ActionController
{
    public function getAction()
    {
        $addressUid = (int)$this->request->getArgument('uid');
        if (!empty($addressUid)) {
            $address = AddressRepository::create()->findByUid($addressUid);
            $this->view->assign('address', $address);
        }
    }
}