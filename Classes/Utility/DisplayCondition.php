<?php

namespace BERGWERK\BwrkAddress\Utility;

use BERGWERK\BwrkAddress\Domain\Object\EntryType;

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

    public function entryValue($arguments, $conditions)
    {
        $configuration = $this->getEntryType($arguments);

        return (
            !$configuration->getIsRte() &&
            !$configuration->getIsFiles() &&
            !$configuration->getIsImages()
        );
    }

    public function entryRte($arguments, $conditions)
    {
        $configuration = $this->getEntryType($arguments);

        return $configuration->getIsRte();
    }

    public function entryFalImages($arguments, $conditions)
    {
        $configuration = $this->getEntryType($arguments);

        return $configuration->getIsImages();
    }

    public function entryFalFiles($arguments, $conditions)
    {
        $configuration = $this->getEntryType($arguments);

        return $configuration->getIsFiles();
    }
}