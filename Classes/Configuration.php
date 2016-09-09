<?php

namespace BERGWERK\BwrkAddress;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class Configuration
 * @package BERGWERK\BwrkAddress
 */
class Configuration extends \BERGWERK\BwrkUtility\Configuration
{
    /**
     * @return mixed
     */
    public static function getTypes()
    {
        return self::getConfiguration('plugin.tx_bwrkaddress.setup.types.');
    }
    public static function getStoragePid()
    {
        return self::getConfiguration('plugin.tx_bwrkaddress.settings.storagePid');
    }
}