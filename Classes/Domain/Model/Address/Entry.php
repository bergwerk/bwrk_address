<?php

namespace BERGWERK\BwrkAddress\Domain\Model\Address;

use BERGWERK\BwrkAddress\Configuration;
use BERGWERK\BwrkAddress\Domain\Model\AbstractModel;
use BERGWERK\BwrkAddress\Domain\Object\EntryType;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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

    public function getReadableValue()
    {
        return $this->entryValue;
    }

    /**
     * @return EntryType
     */
    public function getEntryType()
    {
        return EntryType::read($this->entryType);
    }
}