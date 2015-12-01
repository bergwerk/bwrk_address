<?php

namespace BERGWERK\BwrkAddress\Configuration\Tca;

use BERGWERK\BwrkAddress\Bootstrap;
use BERGWERK\BwrkUtility\Utility\Tca\Configuration;
use BERGWERK\BwrkUtility\Utility\Tca\Tca;

class AddressTca extends Tca
{
    public function __construct()
    {
        $configuration = new Configuration();
        $configuration->setExt(Bootstrap::$_extKey);
        $configuration->setModel('address');

        $this->init($configuration);
    }

    public function render()
    {
        return $this->createTca();
    }
}