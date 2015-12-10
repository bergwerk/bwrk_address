<?php

namespace BERGWERK\BwrkAddress\Domain\Object;

use BERGWERK\BwrkAddress\Configuration;

class EntryType
{
    protected $_config;

    public static function read($type)
    {
        $configuration = Configuration::getTypes();

        $entryType = new EntryType();
        $entryType->_config = isset($configuration[$type]) ? $configuration[$type] : null;

        return $entryType;
    }

    protected function checkConfigurationFlag($flag)
    {
        $value = isset($this->_config[$flag]) ? $this->_config[$flag] : null;

        return $value == '1';
    }

    public function getIsRte()
    {
        return $this->checkConfigurationFlag('rte');
    }

    public function getIsFiles()
    {
        return $this->checkConfigurationFlag('files');
    }

    public function getIsImages()
    {
        return $this->checkConfigurationFlag('images');
    }

    public function getLabel()
    {
        return $this->_config['label'];
    }
}