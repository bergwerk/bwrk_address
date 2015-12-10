<?php

$tcaConfiguration = new \BERGWERK\BwrkUtility\Utility\Tca\Configuration();
$tcaConfiguration->setExt(\BERGWERK\BwrkAddress\Bootstrap::$_extKey);
$tcaConfiguration->setModel('tx_bwrkaddress_domain_model_address_entry');
$tcaConfiguration->setLabelField('entry_value');
$tcaConfiguration->setIconFile('EXT:bwrk_address/Resources/Public/Icons/AddressEntry.svg');
$tcaConfiguration->setHideTable(true);
$tcaConfiguration->setLabelUserFunc("BERGWERK\\BwrkAddress\\Utility\\BackendLabel->entityType");
$tcaConfiguration->addRequestUpdateColumn('entry_type');

$tca = new \BERGWERK\BwrkUtility\Utility\Tca\Tca();
$tca->init($tcaConfiguration);

$tca->addSelectFieldFunc('entry_type', "BERGWERK\\BwrkAddress\\Utility\\BackendSelect->entityTypes");

$tca->addInputField('entry_value', null, null, null, null, null, null, 'USER:BERGWERK\\BwrkAddress\\Utility\\DisplayCondition->entryValue');
$tca->addTextField('entry_rte', true, null, null, null, null, 'USER:BERGWERK\BwrkAddress\Utility\DisplayCondition->entryRte');
$tca->addFalImageReference('entry_fal_images', null, null, null, null, 'USER:BERGWERK\BwrkAddress\Utility\DisplayCondition->entryFalImages');
$tca->addSysFileReference('entry_fal_files', null, null, null, null, null, 'USER:BERGWERK\BwrkAddress\Utility\DisplayCondition->entryFalFiles');

return $tca->createTca();