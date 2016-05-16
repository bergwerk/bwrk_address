<?php

$tcaConfiguration = new \BERGWERK\BwrkUtility\Utility\Tca\Configuration();
$tcaConfiguration->setExt(\BERGWERK\BwrkAddress\Bootstrap::$_extKey);
$tcaConfiguration->setModel('tx_bwrkaddress_domain_model_address_entry');
$tcaConfiguration->ctrl->setLabel('entry_value');
$tcaConfiguration->ctrl->setIconFile('EXT:bwrk_address/Resources/Public/Icons/AddressEntry.svg');
$tcaConfiguration->ctrl->setHideTable(true);
$tcaConfiguration->ctrl->setLabelUserFunc("BERGWERK\\BwrkAddress\\Utility\\BackendLabel->entityType");
$tcaConfiguration->ctrl->setRequestUpdate('entry_type');

$tca = new \BERGWERK\BwrkUtility\Utility\Tca\Tca();
$tca->init($tcaConfiguration);

$entryType = new \BERGWERK\BwrkUtility\Utility\Tca\Dummy\Column('entry_type');
$entryType->setItemsProcFunc("BERGWERK\\BwrkAddress\\Utility\\BackendSelect->entityTypes");
$entryType->setSize(1);
$entryType->setRenderType('selectSingle');
$tca->addSelectFieldFunc($entryType);

$entryValue = new \BERGWERK\BwrkUtility\Utility\Tca\Dummy\Column('entry_value');
$entryValue->setLabel(null);
$entryValue->setExclude(null);
$entryValue->setSize(null);
$entryValue->setMax(null);
$entryValue->setReadOnly(null);
$entryValue->setEval(null);
$entryValue->setDisplayCond('USER:BERGWERK\\BwrkAddress\\Utility\\DisplayCondition->entryValue');
$tca->addInputField($entryValue);

$entryRte = new \BERGWERK\BwrkUtility\Utility\Tca\Dummy\Column('entry_rte');
$entryRte->setRte(true);
$entryRte->setLabel(null);
$entryRte->setExclude(null);
$entryRte->setCols(null);
$entryRte->setRows(null);
$entryRte->setDisplayCond('USER:BERGWERK\\BwrkAddress\\Utility\\DisplayCondition->entryRte');
$tca->addTextField($entryRte);


$entryFalImages = new \BERGWERK\BwrkUtility\Utility\Tca\Dummy\Column('entry_fal_images');
$entryFalImages->setExclude(null);
$entryFalImages->setMinItems(null);
$entryFalImages->setMaxItems(null);
$entryFalImages->setLabel(null);
$entryFalImages->setDisplayCond('USER:BERGWERK\\BwrkAddress\\Utility\\DisplayCondition->entryFalImages');
$tca->addFalImageReference($entryFalImages);

$entryFalFiles = new \BERGWERK\BwrkUtility\Utility\Tca\Dummy\Column('entry_fal_files');
$entryFalFiles->setDisplayCond('USER:BERGWERK\\BwrkAddress\\Utility\\DisplayCondition->entryFalFiles');
$tca->addSysFileReference($entryFalFiles);

return $tca->createTca();