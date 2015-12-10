<?php

namespace BERGWERK\BwrkAddress\Domain\Model;

/**
 * Class Address
 * @package BERGWERK\BwrkAddress\Domain\Model
 */
class Address extends AbstractModel
{
    /** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\BERGWERK\BwrkAddress\Domain\Model\Category> */
    protected $categories;

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getCategories()
    {
        return $this->categories;
    }


}