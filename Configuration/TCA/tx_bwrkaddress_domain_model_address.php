<?php

require_once \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:bwrk_utility/Classes/Utility/Tca/Configuration.php');
require_once \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:bwrk_utility/Classes/Utility/Tca/AbstractTca.php');
require_once \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:bwrk_utility/Classes/Utility/Tca/Tca.php');
require_once \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:bwrk_address/Classes/Configuration/Tca/AddressTca.php');

$tcaConfiguration = new \BERGWERK\BwrkUtility\Utility\Tca\Configuration();
$tcaConfiguration->setExt(\BERGWERK\BwrkAddress\Bootstrap::$_extKey);
$tcaConfiguration->setModel('tx_bwrkaddress_domain_model_address');
$tcaConfiguration->setLabelField('title');
$tcaConfiguration->setIconFile('EXT:bwrk_address/Resources/Public/Icons/Address.png');

$tca = new \BERGWERK\BwrkUtility\Utility\Tca\Tca();
$tca->init($tcaConfiguration);

return $tca->createTca();