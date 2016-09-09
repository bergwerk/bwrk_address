<?php
namespace BERGWERK\BwrkAddress\Utility;

use BERGWERK\BwrkAddress\Bootstrap;
use BERGWERK\BwrkAddress\Domain\Repository\Address\EntryRepository;
use BERGWERK\BwrkAddress\Domain\Repository\AddressRepository;
use TYPO3\CMS\Backend\Form\Element\UserElement;
use TYPO3\CMS\Backend\Template\DocumentTemplate;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Map
{

    const LLL = 'LLL:EXT:bwrk_address/Resources/Private/Language/locallang_db.xlf:tx_bwrkaddress_domain_model_address';

    /**
     * @var float
     */
    protected $lat = 0.0;
    /**
     * @var float
     */
    protected $lng = 0.0;
    /**
     * @var string
     */
    protected $address = '';
    /**
     * @var string
     */
    protected $city = '';
    /**
     * @var string
     */
    protected $zip = '';
    /**
     * @var string
     */
    protected $countryCode = '';

    protected $baseElementId = 0;

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
     */
    protected $configurationManager;

    /**
     * @var array
     */
    protected $settings = array();

    /**
     * @param array $PA
     * @param UserElement $userElement
     * @return string
     */
    public function render(array &$PA, UserElement $userElement)
    {
        ini_set('display_errors', 1);
        /** @var $flashMessageService \TYPO3\CMS\Core\Messaging\FlashMessageService */
        $flashMessageService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessageService');
        $defaultFlashMessageQueue = $flashMessageService->getMessageQueueByIdentifier();


        $this->configurationManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
        $this->settings = $this->getSettings();

        $showMap = false;

        $out = array();
        $this->lat = (float)$PA['row'][$PA['parameters']['lat']];
        $this->lng = (float)$PA['row'][$PA['parameters']['lng']];

        $apiKey = null;

        $_extConfig = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][Bootstrap::$_extKey]);
        if(array_key_exists('googleMapsKey', $_extConfig) && !empty($_extConfig['googleMapsKey'])) $apiKey = $_extConfig['googleMapsKey'];

        $this->address = null;
        $this->zip = null;
        $this->city = null;
        $this->countryCode = 'DE';

        $addressArray = array('street_address', 'zip', 'city', 'country');

        if (!empty($PA['row']['entries'])) {
            $entries = array();
            $entryIds = explode(',', $PA['row']['entries']);
            foreach ($entryIds as $entryId) {
                $entry = EntryRepository::create()->findByUid($entryId);
                if(is_null($entry)) continue;
                foreach ($addressArray as $item) {
                    if ($entry->getEntryType()->getKey() == $item) {
                        $entries[$item] = $entry;
                    }
                }
            }

            if (array_key_exists('street_address', $entries)) {
                $this->address = $entries['street_address']->getEntryValue();
            }
            if (array_key_exists('zip', $entries)) {
                $this->zip = $entries['zip']->getEntryValue();
            }
            if (array_key_exists('city', $entries)) {
                $this->city = $entries['city']->getEntryValue();
            }
            if (array_key_exists('country', $entries)) {
                $this->countryCode = $entries['country']->getEntryValue();
            }
        }


        if (!is_null($this->address) && !is_null($this->city) && !is_null($this->zip) && !is_null($this->countryCode)) {
            $showMap = true;
        }


        if (!$showMap) {
            /** @var $flashMessage FlashMessage */
            $flashMessage = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
                'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
                \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate(self::LLL.'.map.error',Bootstrap::$_extKey),
                htmlspecialchars('Danger'),
                \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR,
                false
            );
            $defaultFlashMessageQueue->enqueue($flashMessage);
        }

        $elementUid = $PA['row']['uid'];

        $this->baseElementId = isset($PA['itemFormElID']) ? $PA['itemFormElID'] : $PA['table'];
        $addressName = 'data[' . $PA['table'] . '][' . $elementUid . '][address]';
        $mapId = $PA['table'] . '_' . $elementUid . '_' . '_map';


        if (is_null($apiKey)) {
            $showMap = false;

            $out[] = '<p>'.\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate(self::LLL.'.map.noKey',Bootstrap::$_extKey).'</p>';
        }

        if ($showMap) {
            $out[] = '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=' . $apiKey . '&language=de"></script>';
            $out[] = '<script type="text/javascript" src="' . ExtensionManagementUtility::extRelPath('bwrk_address') . 'Resources/Public/Js/BackendMap.js"></script>';

            $out[] = '<script type="text/javascript">';
            $out[] = '
            var thisMap = MarkerMap;
                thisMap.entityUid = ' . $elementUid . ';
                thisMap.modelName = "tx_bwrkaddress_domain_model_address";
                thisMap.defaultLat = parseFloat(' . $this->lat . ');
                thisMap.defaultLng = parseFloat(' . $this->lng . ');

                window.onload = function() {
                    thisMap.init("' . $mapId . '", "' . $addressName . '");
                    thisMap.codeAddress("' . $this->address . ', ' . $this->countryCode . ' ' . $this->zip . ' ' . $this->city . '");
                };
            ';
            $out[] = '</script>';
        }

        $out[] = '<div id="' . $this->baseElementId . '">';

        if ($showMap) {
            $out[] = '<div id="' . $mapId . '" style="height:400px;width:100%"></div>';
        }
        $out[] = '</div>';


        return implode('', $out);
    }

    private function getSettings()
    {
        $settings = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        return $settings['plugin.']['tx_bwrkaddress.']['settings.'];

    }
}