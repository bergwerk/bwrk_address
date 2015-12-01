<?php

namespace BERGWERK\BwrkAddress;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Configuration extends \BERGWERK\BwrkUtility\Configuration
{
    public static function getTypes()
    {
        $types = self::getConfiguration('plugin.tx_bwrkaddress.setup.types.');

        DebuggerUtility::var_dump($types);
    }
}