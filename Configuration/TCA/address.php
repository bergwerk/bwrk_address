<?php

require_once \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:bwrk_utility/Classes/Utility/Tca/Configuration.php');
require_once \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:bwrk_utility/Classes/Utility/Tca/AbstractTca.php');
require_once \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:bwrk_utility/Classes/Utility/Tca/Tca.php');
require_once \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:bwrk_address/Classes/Configuration/Tca/AddressTca.php');

$tcaConfiguration = new \BERGWERK\BwrkUtility\Utility\Tca\Configuration();
$tcaConfiguration->setExt(\BERGWERK\BwrkAddress\Bootstrap::$_extKey);
$tcaConfiguration->setModel('tx_bwrkaddress_domain_model_address');
$tcaConfiguration->setModelClass('Address');
$tcaConfiguration->setLabelField('title');

$tca = new \BERGWERK\BwrkUtility\Utility\Tca\Tca();
$tca->init($tcaConfiguration);

$tca->addInputField('title', 'Title');
$tca->addTextField('short_description', true, 'Short Description');
$tca->addSysFileReference('main_image', 0, 1, 1, 'Main Image', BERGWERK\BwrkUtility\Utility\Tca\Tca::ExtensionsImage);

$tca->addTab('tab_text', 'Text');

$tca->addTextField('job_description', true, 'Job Description');
$tca->addTextField('service_description', true, 'Service Description');
$tca->addTextField('long_description', true, 'Long Description');

$tca->addTab('tab_customer', 'Customer');

$tca->addInputField('customer_name', 'Name');
$tca->addInputField('customer_contact', 'Contact');
$tca->addInputField('customer_street', 'Street');
$tca->addInputField('customer_house', 'House');
$tca->addInputField('customer_zip', 'Zip');
$tca->addInputField('customer_city', 'City');
$tca->addInputField('customer_region', 'Region');
$tca->addInputField('customer_country', 'Country');
$tca->addInputField('customer_website', 'Website');
$tca->addInputField('customer_phone', 'Phone');
$tca->addInputField('customer_fax', 'Fax');
$tca->addInputField('customer_email', 'Email');

$tca->addTab('tab_references', 'References');

$tca->addSysCategoryReferences('categories', 0, 10, 0, 999, 'Categories', 'Tx_Bwrkreferences_Category');
$tca->addSysFileReference('images', 0, 0, 999, 'Additional Images', BERGWERK\BwrkUtility\Utility\Tca\Tca::ExtensionsImage);
$tca->addSysFileReference('files', 0, 0, 999, 'Files');

return $tca->createTca();