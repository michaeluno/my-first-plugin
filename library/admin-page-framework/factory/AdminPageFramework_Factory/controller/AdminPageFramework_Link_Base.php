<?php
/**
 Admin Page Framework v3.5.4b06 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
abstract class MyFirstPlugin_AdminPageFramework_Link_Base extends MyFirstPlugin_AdminPageFramework_WPUtility {
    protected function _setFooterInfoLeft($aScriptInfo, &$sFooterInfoLeft) {
        $_sDescription = $this->getAOrB(empty($aScriptInfo['sDescription']), '', "&#13;{$aScriptInfo['sDescription']}");
        $_sVersion = $this->getAOrB(empty($aScriptInfo['sVersion']), '', "&nbsp;{$aScriptInfo['sVersion']}");
        $_sPluginInfo = $this->getAOrB(empty($aScriptInfo['sURI']), $aScriptInfo['sName'], $this->generateHTMLTag('a', array('href' => $aScriptInfo['sURI'], 'target' => '_blank', 'title' => $aScriptInfo['sName'] . $_sVersion . $_sDescription), $aScriptInfo['sName']));
        $_sAuthorInfo = $this->getAOrB(empty($aScriptInfo['sAuthorURI']), '', $this->generateHTMLTag('a', array('href' => $aScriptInfo['sAuthorURI'], 'target' => '_blank', 'title' => $aScriptInfo['sAuthor'],), $aScriptInfo['sAuthor']));
        $_sAuthorInfo = $this->getAOrB(empty($aScriptInfo['sAuthor']), $_sAuthorInfo, ' by ' . $_sAuthorInfo);
        $sFooterInfoLeft = $_sPluginInfo . $_sAuthorInfo;
    }
    protected function _setFooterInfoRight($aScriptInfo, &$sFooterInfoRight) {
        $_sDescription = $this->getAOrB(empty($aScriptInfo['sDescription']), '', "&#13;{$aScriptInfo['sDescription']}");
        $_sVersion = $this->getAOrB(empty($aScriptInfo['sVersion']), '', "&nbsp;{$aScriptInfo['sVersion']}");
        $_sLibraryInfo = $this->getAOrB(empty($aScriptInfo['sURI']), $aScriptInfo['sName'], $this->generateHTMLTag('a', array('href' => $aScriptInfo['sURI'], 'target' => '_blank', 'title' => $aScriptInfo['sName'] . $_sVersion . $_sDescription,), $aScriptInfo['sName']));
        $sFooterInfoRight = $this->oMsg->get('powered_by') . '&nbsp;' . $_sLibraryInfo . ",&nbsp;" . $this->generateHTMLTag('a', array('href' => 'http://wordpress.org', 'target' => '_blank', 'title' => 'WordPress' . $GLOBALS['wp_version']), 'WordPress');
    }
}