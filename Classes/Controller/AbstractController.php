<?php

namespace BERGWERK\BwrkAddress\Controller;

use BERGWERK\BwrkAddress\Bootstrap;
use BERGWERK\BwrkUtility\Utility\CacheUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class AbstractController
 * @package BERGWERK\BwrkAddress\Controller
 */
class AbstractController extends ActionController
{

    function __construct()
    {
        ini_set('display_errors', 1);
    }

    /**
     * @var \BERGWERK\BwrkUtility\Utility\CacheUtility
     */
    protected $cacheUtility;

    protected $contentObject;

    protected function initializeAction()
    {
        $this->cacheUtility = new CacheUtility(Bootstrap::$_extKey);
        $this->contentObject = $this->configurationManager->getContentObject();
    }
}