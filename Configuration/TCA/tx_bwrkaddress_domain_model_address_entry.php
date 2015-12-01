<?php

$tcaConfiguration = new \BERGWERK\BwrkUtility\Utility\Tca\Configuration();
$tcaConfiguration->setExt(\BERGWERK\BwrkAddress\Bootstrap::$_extKey);
$tcaConfiguration->setModel('tx_bwrkaddress_domain_model_address_entry');
$tcaConfiguration->setLabelField('entry_value');
$tcaConfiguration->setIconFile('EXT:bwrk_address/Resources/Public/Icons/AddressEntry.png');

$tca = new \BERGWERK\BwrkUtility\Utility\Tca\Tca();
$tca->init($tcaConfiguration);

$tca->addInputField('entry_key', 'Key');
$tca->addInputField('entry_value', 'Value');

return $tca->createTca();