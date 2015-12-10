<?php

namespace BERGWERK\BwrkAddress\Domain\Model\Address;

use BERGWERK\BwrkAddress\Configuration;
use BERGWERK\BwrkAddress\Domain\Model\AbstractModel;
use BERGWERK\BwrkAddress\Domain\Object\EntryType;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class Entry
 * @package BERGWERK\BwrkAddress\Domain\Model\Address
 */
class Entry extends AbstractModel
{
    /** @var string  */
    protected $entryType = '';

    /** @var string  */
    protected $entryValue = '';

    /** @var string  */
    protected $entryRte = '';

    /** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> */
    protected $entryFalImages;

    /** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> */
    protected $entryFalFiles;

    /**
     * @return EntryType
     */
    public function getEntryType()
    {
        return EntryType::read($this->entryType);
    }

    /**
     * @return int|string
     */
    public function getReadableValue()
    {
        $entryType = $this->getEntryType();

        switch (true)
        {
            case $entryType->getIsFiles():
                return $this->getEntryFalFiles()->count();
            case $entryType->getIsImages():
                return $this->getEntryFalImages()->count();
            case $entryType->getIsRte():
                return $this->shortenText($this->getEntryRte());
            default:
                return $this->shortenText($this->getEntryValue());
        }
    }

    protected function shortenText($text, $length = 80)
    {
        if (strlen($text) > $length)
        {
            return substr($text, 0, $length) . '...';
        }

        return $text;
    }

    /**
     * @return string
     */
    public function getEntryValue()
    {
        return $this->entryValue;
    }

    /**
     * @return string
     */
    public function getEntryRte()
    {
        return $this->entryRte;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getEntryFalImages()
    {
        return $this->entryFalImages;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getEntryFalFiles()
    {
        return $this->entryFalFiles;
    }


}