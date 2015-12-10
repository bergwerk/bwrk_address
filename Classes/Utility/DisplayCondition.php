<?php

namespace BERGWERK\BwrkAddress\Utility;

use BERGWERK\BwrkAddress\Domain\Object\EntryType;

/**
 * Class DisplayCondition
 * @package BERGWERK\BwrkAddress\Utility
 */
class DisplayCondition
{
    /**
     * @param array $arguments
     * @return EntryType
     */
    protected function getEntryType($arguments)
    {
        $entryType = $arguments['record']['entry_type'][0];
        return EntryType::read($entryType);
    }

    /**
     * @param $arguments
     * @param $conditions
     * @return bool
     */
    public function entryValue($arguments, $conditions)
    {
        $configuration = $this->getEntryType($arguments);

        return (
            !$configuration->getIsRte() &&
            !$configuration->getIsFiles() &&
            !$configuration->getIsImages()
        );
    }

    /**
     * @param $arguments
     * @param $conditions
     * @return bool
     */
    public function entryRte($arguments, $conditions)
    {
        $configuration = $this->getEntryType($arguments);

        return $configuration->getIsRte();
    }

    /**
     * @param $arguments
     * @param $conditions
     * @return bool
     */
    public function entryFalImages($arguments, $conditions)
    {
        $configuration = $this->getEntryType($arguments);

        return $configuration->getIsImages();
    }

    /**
     * @param $arguments
     * @param $conditions
     * @return bool
     */
    public function entryFalFiles($arguments, $conditions)
    {
        $configuration = $this->getEntryType($arguments);

        return $configuration->getIsFiles();
    }
}