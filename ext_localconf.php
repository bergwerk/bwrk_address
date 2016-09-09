<?php

if (!defined('TYPO3_MODE')) die ('Access denied.');

\BERGWERK\BwrkAddress\Bootstrap::extLocalconf();

$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['bwrkAddressMarkerWindow'] = 'EXT:'.$_EXTKEY.'/Classes/Utility/Eid/MarkerWindow.php';
