<?php

if (!defined('TYPO3_MODE')) die ('Access denied.');

\BERGWERK\BwrkAddress\Bootstrap::extTables();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerAjaxHandler (
    'BackendController::saveFields',
    'BERGWERK\\BwrkAddress\\Controller\\BackendController->saveFields'
);