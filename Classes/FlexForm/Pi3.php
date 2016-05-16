<?php

namespace BERGWERK\BwrkAddress\FlexForm;

use BERGWERK\BwrkAddress\Bootstrap;
use BERGWERK\BwrkUtility\Utility\Tca\Configuration;
use BERGWERK\BwrkUtility\Utility\Tca\Dummy\Column;
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
        $address = new Column('address');
        $address->setAllowed('tx_bwrkaddress_domain_model_address');
        $address->setMinItems(1);
        $address->setMaxItems(1);
        $this->addSheet('general', array(
            $this->addPageReference($address)
        ));

        $xml = $this->renderFlexForm();

        return $xml;
    }
}