<?php

namespace BERGWERK\BwrkAddress\Utility;

use BERGWERK\BwrkAddress\Configuration;

class BackendSelect
{
    protected function pleaseChooseItem()
    {
        return array('- Please choose -', '');
    }

    public function entityTypes(&$parameters)
    {
        $types = Configuration::getTypes();

        $parameters['items'][] = $this->pleaseChooseItem();

        if (is_null($types))
        {
            return;
        }

        foreach ($types as $key => $type) {
            $parameters['items'][] = array(
                $type['label'],
                $key
            );
        }
    }
}