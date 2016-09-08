<?php

namespace BERGWERK\BwrkAddress\Controller;

use BERGWERK\BwrkAddress\Domain\Model\Address;
use BERGWERK\BwrkAddress\Domain\Repository\AddressRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class BackendController extends ActionController
{
    public function saveFields($params = array(), \TYPO3\CMS\Core\Http\AjaxRequestHandler &$ajaxObj = NULL)
    {
        $parsedBody = $params['request']->getParsedBody();

        $latitude = null;
        $longitude = null;
        $uid = null;

        if(array_key_exists('latitude', $parsedBody)) $latitude = $parsedBody['latitude'];
        if(array_key_exists('longitude', $parsedBody)) $longitude = $parsedBody['longitude'];
        if(array_key_exists('uid', $parsedBody)) $uid = $parsedBody['uid'];

        if(!is_null($latitude) && !is_null($longitude) && !is_null($uid))
        {
            /** @var Address $address */
            $address = AddressRepository::create()->findByUid($uid);
            $address->setLatitude($latitude);
            $address->setLongitude($longitude);

            AddressRepository::create()->update($address);

            $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
            $persistenceManager = $objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
            $persistenceManager->persistAll();

            return true;
        }
        return false;
    }
}