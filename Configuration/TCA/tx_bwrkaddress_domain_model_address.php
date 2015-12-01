<?php

$tcaConfiguration = new \BERGWERK\BwrkUtility\Utility\Tca\Configuration();
$tcaConfiguration->setExt(\BERGWERK\BwrkAddress\Bootstrap::$_extKey);
$tcaConfiguration->setModel('tx_bwrkaddress_domain_model_address');
$tcaConfiguration->setLabelField('title');
$tcaConfiguration->setIconFile('EXT:bwrk_address/Resources/Public/Icons/Address.png');

$tca = new \BERGWERK\BwrkUtility\Utility\Tca\Tca();
$tca->init($tcaConfiguration);

return $tca->createTca();