<?php
$tcaConfiguration = new \BERGWERK\BwrkUtility\Utility\Tca\Configuration();
$tcaConfiguration->setExt(\BERGWERK\BwrkAddress\Bootstrap::$_extKey);
$tcaConfiguration->setModel('tx_bwrkaddress_domain_model_address');
$tcaConfiguration->ctrl->setLabel('title');
$tcaConfiguration->ctrl->setIconFile('EXT:bwrk_address/Resources/Public/Icons/Address.svg');

$tca = new \BERGWERK\BwrkUtility\Utility\Tca\Tca();
$tca->init($tcaConfiguration);

$tca->addInputField(new \BERGWERK\BwrkUtility\Utility\Tca\Dummy\Column('title'));

$entries = new \BERGWERK\BwrkUtility\Utility\Tca\Dummy\Column('entries');
$entries->setForeignTable('tx_bwrkaddress_domain_model_address_entry');
$entries->setForeignField('address');
$entries->setForeignSortBy('sorting');
$entries->setAppearance(array(
    'collapseAll' => true,
    'useSortable' => true,
    'showHeader' => false,
    'showPossibleLocalizationRecords' => true,

    'enabledControls' => array(
        'sort' => false,
    )
));
$entries->setExpandAll(true);
$tca->addReferenceField($entries);

$jsUserFunc = new \BERGWERK\BwrkUtility\Utility\Tca\Dummy\Column('jsUserFunc');
$jsUserFunc->setUserFunc('BERGWERK\\BwrkAddress\\Utility\\BackendButton->addButton');
$tca->addUserFunc($jsUserFunc);

$map = new \BERGWERK\BwrkUtility\Utility\Tca\Dummy\Column('map');
$map->setUserFunc('BERGWERK\\BwrkAddress\\Utility\\Map->render');
$map->setParameters(array(
    'lat' => 'latitude',
    'lng' => 'longitude',
));
$tca->addUserFunc($map);

$tca->addInputField(new \BERGWERK\BwrkUtility\Utility\Tca\Dummy\Column('latitude'));
$tca->addInputField(new \BERGWERK\BwrkUtility\Utility\Tca\Dummy\Column('longitude'));


$tca->addTab('tab_references');

$categories = new \BERGWERK\BwrkUtility\Utility\Tca\Dummy\Column('categories');
$categories->setSize(20);
$tca->addSysCategoryReferences($categories);


return $tca->createTca();