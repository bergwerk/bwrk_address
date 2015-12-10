<?php

namespace BERGWERK\BwrkAddress\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class AbstractController
 * @package BERGWERK\BwrkAddress\Controller
 */
class AbstractController extends ActionController
{
    protected $contentObject;

    protected function initializeAction()
    {
        $this->contentObject = $this->configurationManager->getContentObject();
    }
}