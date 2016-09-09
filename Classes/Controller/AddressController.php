<?php

namespace BERGWERK\BwrkAddress\Controller;

use BERGWERK\BwrkAddress\Bootstrap;
use BERGWERK\BwrkAddress\Domain\Model\Address;
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
        $addressUid = (int)$this->settings['address'];

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

    public function listNewAction()
    {
        $apiKey = null;

        $_extConfig = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][Bootstrap::$_extKey]);
        if(array_key_exists('googleMapsKey', $_extConfig) && !empty($_extConfig['googleMapsKey'])) $apiKey = $_extConfig['googleMapsKey'];


        $addresses = AddressRepository::create()->findAll();

        $cObj = $this->contentObject->data;

        $settings = $this->settings;
        $mapStyling = $settings['map']['styling'];
        if($this->isJson($mapStyling))
        {
            $mapStyling = json_decode($mapStyling);
            $mapStyling = json_encode($mapStyling, JSON_UNESCAPED_SLASHES);
        }
        $settings['map']['styling'] = $mapStyling;

        $this->view->assignMultiple(array(
            'cObj' => $cObj,
            'pageId' => $GLOBALS['TSFE']->id,
            'markersJs' => $this->buildMarkerJs($addresses, $cObj),
            'settings' => $settings,
            'apiKey' => $apiKey
        ));
    }

    private function buildMarkerJs($addresses, $cObj)
    {
        $js = '';
        $js.= 'var bwrkAddressMapMarkers_'.$cObj['uid'].' = [];';
        /** @var Address $address */
        $i=0;
        foreach($addresses as $address)
        {
            $js.= '
            bwrkAddressMapMarkers_'.$cObj['uid'].'['.$i.'] = {
                title: "'.$address->getTitle().'",
                position: {lat: '.$address->getLatitude().', lng: '.$address->getLongitude().'},
                uid: '.$address->getUid().',';
            if(!empty($this->settings['map']['marker']['styling']))
            {
                $js.= 'icon: '.$this->settings['map']['marker']['styling'];
            }
            $js.= '};';
            $i++;
        }
        return $js;
    }

    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}