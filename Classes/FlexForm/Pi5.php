<?php

namespace BERGWERK\BwrkAddress\FlexForm;

use BERGWERK\BwrkAddress\Bootstrap;
use BERGWERK\BwrkUtility\Utility\Tca\Configuration;
use BERGWERK\BwrkUtility\Utility\Tca\Dummy\Column;
use BERGWERK\BwrkUtility\Utility\Tca\FlexForm;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class Pi5
 * @package BERGWERK\BwrkAddress\FlexForm
 */
class Pi5 extends FlexForm
{
    /**
     * Pi1 constructor.
     */
    public function __construct()
    {
        $configuration = new Configuration();
        $configuration->setExt(Bootstrap::$_extKey);
        $configuration->setPlugin('Pi5');

        $this->init($configuration);
    }

    /**
     * @return string
     */
    public function render()
    {
        $sortBy = new Column('sort_by');
        $sortBy->setRenderType('selectSingle');
        $sortBy->setSize(1);
        $sortBy->setItemsLabelPath($this->conf->getLl());
        $sortBy->setItems(array(
            array(
                'name' => 'title',
                'value' => 'title'
            )
        ));
        $sortWith = new Column('sort_with');
        $sortWith->setRenderType('selectSingle');
        $sortWith->setSize(1);
        $sortWith->setItemsLabelPath($this->conf->getLl());
        $sortWith->setItems(array(
            array(
                'name' => 'ascending',
                'value' => 'ascending'
            ),
            array(
                'name' => 'descending',
                'value' => 'descending'
            )
        ));

        $mapStyling = new Column('map.styling');
        $mapStyling->setDisplayCond('FIELD:settings.render_as_map:=:1');

        $renderAsMap = new Column('render_as_map');
        $renderAsMap->setOnChange();

        $markerStyling = new Column('map.marker.styling');
        $markerStyling->setDisplayCond('FIELD:settings.render_as_map:=:1');

        $zoom = new Column('map.zoom');
        $zoom->setDisplayCond('FIELD:settings.render_as_map:=:1');
        $zoom->setDefault('10');

        $defaultLat = new Column('map.latitude');
        $defaultLat->setDisplayCond('FIELD:settings.render_as_map:=:1');
        $defaultLat->setDefault('50.1397337');

        $defaultLng = new Column('map.longitude');
        $defaultLng->setDefault('11.5800453');
        $defaultLng->setDisplayCond('FIELD:settings.render_as_map:=:1');

        $this->addSheet('general', array(
            $this->addSelectField($sortBy),
            $this->addSelectField($sortWith),
        ));
        $this->addSheet('map', array(
            $this->addCheckField($renderAsMap),
            $this->addInputField($zoom),
            $this->addInputField($defaultLat),
            $this->addInputField($defaultLng),
            $this->addTextField($mapStyling),
            $this->addTextField($markerStyling)
        ));

        $xml = $this->renderFlexForm();

        return $xml;
    }
}