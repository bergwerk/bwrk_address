<?php

namespace BERGWERK\BwrkAddress\FlexForm;

use BERGWERK\BwrkAddress\Bootstrap;
use BERGWERK\BwrkUtility\Utility\Tca\Configuration;
use BERGWERK\BwrkUtility\Utility\Tca\FlexForm;

/**
 * Class Pi4
 * @package BERGWERK\BwrkAddress\FlexForm
 */
class Pi4 extends FlexForm
{
    /**
     * Pi4 constructor.
     */
    public function __construct()
    {
        $configuration = new Configuration();
        $configuration->setExt(Bootstrap::$_extKey);
        $configuration->setPlugin('Pi4');

        $this->init($configuration);
    }

    /**
     * @return string
     */
    public function render()
    {
        $this->addSheet('general', array(
            $this->addSingleRelationField('records', 'tx_bwrkaddress_domain_model_address', 10, 999)
        ));

        $xml = $this->renderFlexForm();

        return $xml;
    }
}