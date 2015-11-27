<?php

if (!defined('TYPO3_MODE')) die ('Access denied.');

require_once \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:bwrk_address/Classes/Bootstrap.php');

\BERGWERK\BwrkAddress\Bootstrap::extLocalconf();