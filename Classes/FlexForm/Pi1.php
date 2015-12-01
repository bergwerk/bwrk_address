<?php

namespace BERGWERK\BwrkAddress\FlexForm;

use BERGWERK\BwrkAddress\Bootstrap;
use BERGWERK\BwrkUtility\Utility\Tca\Configuration;
use BERGWERK\BwrkUtility\Utility\Tca\FlexForm;

class Pi1 extends FlexForm
{
    public function __construct()
    {
        $configuration = new Configuration();
        $configuration->setExt(Bootstrap::$_extKey);
        $configuration->setPlugin('Pi1');

        $this->init($configuration);
    }

    /**
     * @return string
     */
    public function render()
    {
        $this->addSheet('general', array(
            $this->addSysCategoryReferences('categories')
        ));

        return $this->renderFlexForm();
    }
}