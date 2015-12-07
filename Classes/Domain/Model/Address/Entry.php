<?php

namespace BERGWERK\BwrkAddress\Domain\Model\Address;

use BERGWERK\BwrkAddress\Configuration;
use BERGWERK\BwrkAddress\Domain\Model\AbstractModel;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Entry extends AbstractModel
{
    /** @var string  */
    protected $entryType = '';

    /** @var string  */
    protected $entryValue = '';

    /**
     * @return string
     */
    public function getEntryType()
    {
        return $this->entryType;
    }

    /**
     * @param string $entryType
     */
    public function setEntryType($entryType)
    {
        $this->entryType = $entryType;
    }

    /**
     * @return string
     */
    public function getEntryValue()
    {
        return $this->entryValue;
    }

    /**
     * @param string $entryValue
     */
    public function setEntryValue($entryValue)
    {
        $this->entryValue = $entryValue;
    }

    /**
     * @return null|array
     */
    public function getEntryTypeConfiguration()
    {
        $type = $this->getEntryType();
        $configuration = Configuration::getTypes();

        return isset($configuration[$type]) ? $configuration[$type] : null;
    }

    protected function checkConfigurationFlag($flag)
    {
        $configuration = $this->getEntryTypeConfiguration();

        $value = isset($configuration[$flag]) ? $configuration[$flag] : null;

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
}