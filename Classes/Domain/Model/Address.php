<?php

namespace BERGWERK\BwrkAddress\Domain\Model;
use BERGWERK\BwrkAddress\Domain\Repository\Address\EntryRepository;

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
     * @var string
     */
    protected $latitude = '';
    /**
     * @var string
     */
    protected $longitude = '';

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
     * @return Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param string $entryType
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getEntriesWithType($entryType)
    {
        return EntryRepository::create()->findByAddressAndType($this, $entryType);
    }

    /**
     * @return array[int]
     */
    public function getCategoryUids()
    {
        $uids = array();

        foreach ($this->getCategories() as $category)
        {
            $uids[] = (int) $category->getUid();
        }

        return $uids;
    }

    /**
     * @return string
     */
    public function getCategoryUidsJson()
    {
        return json_encode(
            $this->getCategoryUids()
        );
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

}