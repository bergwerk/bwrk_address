<?php
namespace BERGWERK\BwrkAddress\Utility;

class BackendButton {
    public function addButton($PA, $fObj)
    {
        $uid = $PA['row']['uid'];
        $pid = $PA['row']['pid'];

        $collapseTitle = 'Collapse All';
        $expandTitle = 'Expand All';
        $class = 'typo3-expandCollapseAllLink';

        $html = '<div class="'.$class.'" style="display: inline;margin-left: 10px;" title="'.$collapseTitle.'"><a href="#" class="btn btn-default" onclick="return bwrkAddressCollapseAll(this);">'.$collapseTitle.'</a></div>';

        $script = '<script type="text/javascript">';
        $script.= 'TYPO3.jQuery(document).ready(function() {
            TYPO3.jQuery("#data-'.$pid.'-tx_bwrkaddress_domain_model_address-'.$uid.'-entries > .t3js-formengine-validation-marker").append(\''.$html.'\');
		});
		function bwrkAddressExpandAll(link) {
            TYPO3.jQuery(link).parents(".t3js-formengine-field-item").find(".panel-group").children().each(function()
            {
                TYPO3.jQuery(this).removeClass("panel-collapsed");
                TYPO3.jQuery(this).removeClass("panel-visible");
                TYPO3.jQuery(this).addClass("panel-visible");
            });
            TYPO3.jQuery(link).text("'.$collapseTitle.'").attr("onclick", "return bwrkAddressCollapseAll(this);");
            return false;
		}
        function bwrkAddressCollapseAll(link) {
            TYPO3.jQuery(link).parents(".t3js-formengine-field-item").find(".panel-group").children().each(function()
            {
                TYPO3.jQuery(this).removeClass("panel-visible");
                TYPO3.jQuery(this).removeClass("panel-collapsed");
                TYPO3.jQuery(this).addClass("panel-collapsed");
            });
            TYPO3.jQuery(link).text("'.$expandTitle.'").attr("onclick", "return bwrkAddressExpandAll(this);");
            return false;
        }';
        $script.= '</script>';
        return $script;
    }
}