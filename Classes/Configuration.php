<?php

namespace BERGWERK\BwrkAddress;

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
}