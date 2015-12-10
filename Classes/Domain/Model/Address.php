<?php

namespace BERGWERK\BwrkAddress\Domain\Model;

/**
 * Class Address
 * @package BERGWERK\BwrkAddress\Domain\Model
 */
class Address extends AbstractModel
{
    /** @var string */
    protected $title = '';

    /** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\BERGWERK\BwrkAddress\Domain\Model\Address\Entry> */
    protected $entries;

    /** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\BERGWERK\BwrkAddress\Domain\Model\Category> */
    protected $categories;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getCategories()
    {
        return $this->categories;
    }


}