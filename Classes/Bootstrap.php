<?php
namespace BERGWERK\BwrkAddress;

use BERGWERK\BwrkAddress\FlexForm\Pi1;
use BERGWERK\BwrkAddress\FlexForm\Pi2;
use BERGWERK\BwrkAddress\FlexForm\Pi3;
use BERGWERK\BwrkAddress\FlexForm\Pi4;
use BERGWERK\BwrkAddress\FlexForm\Pi5;
use BERGWERK\BwrkUtility\Utility\Tca\FlexForm;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

/**
 * Class Bootstrap
 * @package BERGWERK\BwrkAddress
 */
class Bootstrap
{
    /**
     * @var string
     */
    static public $_extKey = 'bwrk_address';

    /**
     *
     */
    static public function extTables()
    {
        // Include TypoScript
        ExtensionManagementUtility::addStaticFile(self::$_extKey, 'Configuration/TypoScript', 'BERGWERK Address');

        // Register Plugins
        self::registerPlugin('Pi1', 'BERGWERK Address (list)', Pi1::class);
        self::registerPlugin('Pi2', 'BERGWERK Address (single)', Pi2::class);
        self::registerPlugin('Pi3', 'BERGWERK Address (detail)', Pi3::class);
        self::registerPlugin('Pi4', 'BERGWERK Address (list manual)', Pi4::class);

        self::registerPlugin('Pi5', 'BERGWERK Address (list) [NEW]', Pi5::class);


    }

    /**
     *
     */
    static public function extLocalconf()
    {
        // Configure Plugins
        ExtensionUtility::configurePlugin('BERGWERK.' . self::$_extKey, 'Pi1',
            array('Address' => 'list'),
            array('Address' => 'list')
        );

        ExtensionUtility::configurePlugin('BERGWERK.' . self::$_extKey, 'Pi2',
            array('Address' => 'single'),
            array('Address' => 'single')
        );

        ExtensionUtility::configurePlugin('BERGWERK.' . self::$_extKey, 'Pi3',
            array('Address' => 'detail'),
            array('Address' => 'detail')
        );

        ExtensionUtility::configurePlugin('BERGWERK.' . self::$_extKey, 'Pi4',
            array('Address' => 'listManual'),
            array('Address' => 'listManual')
        );

        ExtensionUtility::configurePlugin('BERGWERK.' . self::$_extKey, 'Pi5',
            array('Address' => 'listNew'),
            array('Address' => 'listNew')
        );
        ExtensionUtility::configurePlugin('BERGWERK.' . self::$_extKey, 'Pi6',
            array('MarkerWindow' => 'get'),
            array('MarkerWindow' => 'get')
        );
    }

    /**
     * @return \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    static public function getObjectManager()
    {
        return GeneralUtility::makeInstance(
            ObjectManager::class
        );
    }

    /**
     * @return int
     */
    static public function getCurrentLanguage()
    {
        return (int)$GLOBALS['TSFE']->sys_language_uid;
    }

    /**
     * @param $pluginName
     * @param $pluginTitle
     * @param null $flexFormClass
     */
    static protected function registerPlugin($pluginName, $pluginTitle, $flexFormClass = null)
    {
        ExtensionUtility::registerPlugin('BERGWERK.' . self::$_extKey, $pluginName, $pluginTitle);

        if (empty($flexFormClass))
        {
            return;
        }

        /** @var FlexForm $flexFormInstance */
        $flexFormInstance = new $flexFormClass();

        if (!$flexFormInstance instanceof FlexForm)
        {
            return;
        }

        $flexForm = $flexFormInstance->render();

        $pluginSignature = strtolower(GeneralUtility::underscoredToUpperCamelCase(self::$_extKey)) . '_' . strtolower($pluginName);

        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

        ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, $flexForm);
    }
}