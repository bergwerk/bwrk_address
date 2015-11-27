<?php
namespace BERGWERK\BwrkAddress;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

class Bootstrap
{
    static protected $_extKey = 'bwrk_address';

    static public function extTables()
    {
        // Include TypoScript
        ExtensionManagementUtility::addStaticFile(self::$_extKey, 'Configuration/TypoScript', 'BERGWERK Address');

        // Register Plugins
        ExtensionUtility::registerPlugin('BERGWERK.' . self::$_extKey, 'Pi1', 'BERGWERK Address (list)');
        ExtensionUtility::registerPlugin('BERGWERK.' . self::$_extKey, 'Pi2', 'BERGWERK Address (single)');
    }

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
    public static function getCurrentLanguage()
    {
        return (int) $GLOBALS['TSFE']->sys_language_uid;
    }
}