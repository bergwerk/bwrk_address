<?php

namespace BERGWERK\BwrkAddress\Utility\Eid;

use BERGWERK\BwrkAddress\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Core\Bootstrap;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Utility\EidUtility;

class MarkerWindow {
    public function run()
    {
        $bootstrap = new Bootstrap();

        $pId = (GeneralUtility::_GET('id') ? GeneralUtility::_GET('id') : 1);

        $GLOBALS['TSFE'] = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Controller\\TypoScriptFrontendController', $GLOBALS['TYPO3_CONF_VARS'], $pId, 0, true);
        $GLOBALS['TSFE']->connectToDB();
        $GLOBALS['TSFE']->fe_user = EidUtility::initFeUser();
        $GLOBALS['TSFE']->id = $pId;
        $GLOBALS['TSFE']->determineId();
        $GLOBALS['TSFE']->initTemplate();
        $GLOBALS['TSFE']->getConfigArray();
        $GLOBALS['TSFE']->cObj = new ContentObjectRenderer();

        echo $bootstrap->run('', array(
            'pluginName' => 'Pi6',
            'vendorName' => 'BERGWERK',
            'extensionName' => 'BwrkAddress',
            'controller' => 'MarkerWindow',
            'action' => 'get',
            'mvc' => array(
                'requestHandlers' => array(
                    'TYPO3\CMS\Extbase\Mvc\Web\FrontendRequestHandler' => 'TYPO3\CMS\Extbase\Mvc\Web\FrontendRequestHandler'
                )
            ),
            'settings' => array(),
            'persistence'   => array(
                'storagePid' => Configuration::getStoragePid()
            )
        ));
    }
}
$run = GeneralUtility::makeInstance('BERGWERK\\BwrkAddress\\Utility\\Eid\\MarkerWindow');
$run->run();
