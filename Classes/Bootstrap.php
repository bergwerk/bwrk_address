<?php
namespace BERGWERK\BwrkAddress;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

class Bootstrap
{
    static public $_extKey = 'bwrk_address';

    static protected function domainModel($modelName, $labelField = 'title', $isCategorizable = false)
    {
        $domainExtension = 'tx_' . str_replace('_', '', self::$_extKey);
        $modelNameLower = strtolower($modelName);

        $tableName = $domainExtension . '_domain_model_' . $modelNameLower;

        ExtensionManagementUtility::allowTableOnStandardPages($tableName);

        $TCA[$tableName] = array(
            'ctrl' => array(
                'title' => 'LLL:EXT:' . self::$_extKey . '/Resources/Private/Language/locallang_db.xlf:' . $tableName,
                'label' => $labelField,
                'tstamp' => 'tstamp',
                'crdate' => 'crdate',
                'cruser_id' => 'cruser_id',
                'dividers2tabs' => TRUE,
                'versioningWS' => 2,
                'versioning_followPages' => TRUE,
                'origUid' => 't3_origuid',
                'languageField' => 'sys_language_uid',
                'transOrigPointerField' => 'l10n_parent',
                'transOrigDiffSourceField' => 'l10n_diffsource',
                'delete' => 'deleted',
                'enablecolumns' => array(
                    'disabled' => 'hidden',
                    'starttime' => 'starttime',
                    'endtime' => 'endtime',
                ),
                'searchFields' => $labelField,
                'dynamicConfigFile' => ExtensionManagementUtility::extPath(self::$_extKey) . 'Configuration/TCA/' . $modelName . '.php',
                'iconfile' => ExtensionManagementUtility::extRelPath(self::$_extKey) . 'Resources/Public/Icons/' . $tableName . '.gif'
            ),
        );

        if ($isCategorizable) {
            ExtensionManagementUtility::makeCategorizable(self::$_extKey, $tableName);
        }
    }

    static public function extTables()
    {
        // Include TypoScript
        ExtensionManagementUtility::addStaticFile(self::$_extKey, 'Configuration/TypoScript', 'BERGWERK Address');

        // Register Plugins
        ExtensionUtility::registerPlugin('BERGWERK.' . self::$_extKey, 'Pi1', 'BERGWERK Address (list)');
        ExtensionUtility::registerPlugin('BERGWERK.' . self::$_extKey, 'Pi2', 'BERGWERK Address (single)');

        // Register Models
        self::domainModel('address', 'title', true);
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
        return (int)$GLOBALS['TSFE']->sys_language_uid;
    }
}