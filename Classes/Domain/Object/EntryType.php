<?php

namespace BERGWERK\BwrkAddress\Domain\Object;

use BERGWERK\BwrkAddress\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class EntryType
 * @package BERGWERK\BwrkAddress\Domain\Object
 */
class EntryType
{
    /**
     * @var string
     */
    protected $_key;

    /**
     * @var array
     */
    protected $_config;

    /**
     * @param string $type
     * @return EntryType
     */
    public static function read($type)
    {
        $configuration = Configuration::getTypes();

        $entryType = new EntryType();
        $entryType->_key = $type;
        $entryType->_config = isset($configuration[$type]) ? $configuration[$type] : null;

        return $entryType;
    }

    /**
     * @param string $flag
     * @return bool
     */
    protected function checkConfigurationFlag($flag)
    {
        $value = isset($this->_config[$flag]) ? $this->_config[$flag] : null;

        return $value == '1';
    }

    /**
     * @return bool
     */
    public function getIsRte()
    {
        return $this->checkConfigurationFlag('rte');
    }

    /**
     * @return bool
     */
    public function getIsFiles()
    {
        return $this->checkConfigurationFlag('files');
    }

    /**
     * @return bool
     */
    public function getIsImages()
    {
        return $this->checkConfigurationFlag('images');
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->_config['label'];
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->_key;
    }

    public function getKeyUpper()
    {
        return GeneralUtility::underscoredToUpperCamelCase($this->getKey());
    }

    public function getShowInList()
    {
        return $this->checkConfigurationFlag('showInList');
    }
}