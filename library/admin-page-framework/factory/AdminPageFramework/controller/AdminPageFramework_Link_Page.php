<?php
/**
 Admin Page Framework v3.5.4b06 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
class MyFirstPlugin_AdminPageFramework_Link_Page extends MyFirstPlugin_AdminPageFramework_Link_Base {
    public $oProp;
    public function __construct(&$oProp, $oMsg = null) {
        if (!$oProp->bIsAdmin) {
            return;
        }
        $this->oProp = $oProp;
        $this->oMsg = $oMsg;
        if ($oProp->bIsAdminAjax) {
            return;
        }
        $this->oProp->sLabelPluginSettingsLink = null === $this->oProp->sLabelPluginSettingsLink ? $this->oMsg->get('settings') : $this->oProp->sLabelPluginSettingsLink;
        add_action('in_admin_footer', array($this, '_replyToSetFooterInfo'));
        if (in_array($this->oProp->sPageNow, array('plugins.php')) && 'plugin' == $this->oProp->aScriptInfo['sType']) {
            add_filter('plugin_action_links_' . plugin_basename($this->oProp->aScriptInfo['sPath']), array($this, '_replyToAddSettingsLinkInPluginListingPage'));
        }
    }
    public function _replyToSetFooterInfo() {
        if (!$this->oProp->isPageAdded()) {
            return;
        }
        $this->_setFooterInfoLeft($this->oProp->aScriptInfo, $this->oProp->aFooterInfo['sLeft']);
        $this->_setFooterInfoRight($this->oProp->_getLibraryData(), $this->oProp->aFooterInfo['sRight']);
        add_filter('admin_footer_text', array($this, '_replyToAddInfoInFooterLeft'));
        add_filter('update_footer', array($this, '_replyToAddInfoInFooterRight'), 11);
    }
    public function _addLinkToPluginDescription($asLinks) {
        if (!is_array($asLinks)) {
            $this->oProp->aPluginDescriptionLinks[] = $asLinks;
        } else {
            $this->oProp->aPluginDescriptionLinks = array_merge($this->oProp->aPluginDescriptionLinks, $asLinks);
        }
        if ('plugins.php' !== $this->oProp->sPageNow) {
            return;
        }
        add_filter('plugin_row_meta', array($this, '_replyToAddLinkToPluginDescription'), 10, 2);
    }
    public function _addLinkToPluginTitle($asLinks) {
        static $_sPluginBaseName;
        if (!is_array($asLinks)) {
            $this->oProp->aPluginTitleLinks[] = $asLinks;
        } else {
            $this->oProp->aPluginTitleLinks = array_merge($this->oProp->aPluginTitleLinks, $asLinks);
        }
        if ('plugins.php' !== $this->oProp->sPageNow) {
            return;
        }
        if (!isset($_sPluginBaseName)) {
            $_sPluginBaseName = plugin_basename($this->oProp->aScriptInfo['sPath']);
            add_filter("plugin_action_links_{$_sPluginBaseName}", array($this, '_replyToAddLinkToPluginTitle'));
        }
    }
    public function _replyToAddInfoInFooterLeft($sLinkHTML = '') {
        if (!isset($_GET['page']) || !$this->oProp->isPageAdded($_GET['page'])) {
            return $sLinkHTML;
        }
        if (empty($this->oProp->aScriptInfo['sName'])) {
            return $sLinkHTML;
        }
        return $this->oProp->aFooterInfo['sLeft'];
    }
    public function _replyToAddInfoInFooterRight($sLinkHTML = '') {
        if (!isset($_GET['page']) || !$this->oProp->isPageAdded($_GET['page'])) {
            return $sLinkHTML;
        }
        return $this->oProp->aFooterInfo['sRight'];
    }
    public function _replyToAddSettingsLinkInPluginListingPage($aLinks) {
        if (count($this->oProp->aPages) < 1) {
            return $aLinks;
        }
        if (!$this->oProp->sLabelPluginSettingsLink) {
            return $aLinks;
        }
        $_sLinkURL = preg_match('/^.+\.php/', $this->oProp->aRootMenu['sPageSlug']) ? add_query_arg(array('page' => $this->oProp->sDefaultPageSlug), admin_url($this->oProp->aRootMenu['sPageSlug'])) : "admin.php?page={$this->oProp->sDefaultPageSlug}";
        array_unshift($aLinks, '<a href="' . esc_url($_sLinkURL) . '">' . $this->oProp->sLabelPluginSettingsLink . '</a>');
        return $aLinks;
    }
    public function _replyToAddLinkToPluginDescription($aLinks, $sFile) {
        if ($sFile != plugin_basename($this->oProp->aScriptInfo['sPath'])) {
            return $aLinks;
        }
        $_aAddingLinks = array();
        foreach (array_filter($this->oProp->aPluginDescriptionLinks) as $_sLLinkHTML) {
            if (!$_sLLinkHTML) {
                continue;
            }
            if (is_array($_sLLinkHTML)) {
                $_aAddingLinks = array_merge($_sLLinkHTML, $_aAddingLinks);
                continue;
            }
            $_aAddingLinks[] = ( string )$_sLLinkHTML;
        }
        return array_merge($aLinks, $_aAddingLinks);
    }
    public function _replyToAddLinkToPluginTitle($aLinks) {
        $_aAddingLinks = array();
        foreach (array_filter($this->oProp->aPluginTitleLinks) as $_sLinkHTML) {
            if (!$_sLinkHTML) {
                continue;
            }
            if (is_array($_sLinkHTML)) {
                $_aAddingLinks = array_merge($_sLinkHTML, $aAddingLinks);
                continue;
            }
            $_aAddingLinks[] = ( string )$_sLinkHTML;
        }
        return array_merge($aLinks, $_aAddingLinks);
    }
}