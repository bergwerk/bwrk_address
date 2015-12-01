<?php

namespace BERGWERK\BwrkAddress;

class Configuration extends \BERGWERK\BwrkUtility\Configuration
{
    public static function getTypes()
    {
        return self::getConfiguration('plugin.tx_bwrkaddress.setup.types.');
    }
}