<?php

namespace BERGWERK\BwrkAddress\FlexForm;

use BERGWERK\BwrkAddress\Bootstrap;
use BERGWERK\BwrkUtility\Utility\Tca\Configuration;
use BERGWERK\BwrkUtility\Utility\Tca\FlexForm;

/**
 * Class Pi3
 * @package BERGWERK\BwrkAddress\FlexForm
 */
class Pi3 extends FlexForm
{
    /**
     * Pi1 constructor.
     */
    public function __construct()
    {
        $configuration = new Configuration();
        $configuration->setExt(Bootstrap::$_extKey);
        $configuration->setPlugin('Pi3');

        $this->init($configuration);
    }

    /**
     * @return string
     */
    public function render()
    {
        $this->addSheet('general', array(
            $this->addPageReference('address', 'tx_bwrkaddress_domain_model_address', 1, 1, 1)
        ));

        $xml = $this->renderFlexForm();

        return $xml;
    }
}