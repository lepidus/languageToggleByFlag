<?php

/**
 * @file plugins/blocks/flaglanguageToggleBlock/FlagLanguageToggleBlockPlugin.inc.php
 *
 * Copyright (c) 2014-2019 Simon Fraser University
 * Copyright (c) 2003-2019 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class FlagLanguageToggleBlockPlugin
 * @ingroup plugins_blocks_flaglanguageToggle
 *
 * @brief Class for language selector block plugin
 */

import('lib.pkp.classes.plugins.BlockPlugin');

class FlagToggleLanguageBlockPlugin extends BlockPlugin {
	/**
	 * Determine whether the plugin is enabled. Overrides parent so that
	 * the plugin will be displayed during install.
	 *
	 * @param $contextId int Context ID (journal/press)
	 * @return boolean
	 */

	private $flagPath = "/plugins/blocks/flaglanguageToggle/locale/";

	function getEnabled($contextId = null) {
		if (!Config::getVar('general', 'installed')) return true;
		return parent::getEnabled($contextId);
	}

	/**
	 * Install default settings on system install.
	 * @return string
	 */
	function getInstallSitePluginSettingsFile() {
		return $this->getPluginPath() . '/settings.xml';
	}

	/**
	 * Install default settings on journal creation.
	 * @return string
	 */
	function getContextSpecificPluginSettingsFile() {
		return $this->getPluginPath() . '/settings.xml';
	}

	/**
	 * Get the block context. Overrides parent so that the plugin will be
	 * displayed during install.
	 *
	 * @param $contextId int Context ID (journal/press)
	 * @return int
	 */
	function getBlockContext($contextId = null) {
		if (!Config::getVar('general', 'installed')) return BLOCK_CONTEXT_SIDEBAR;
		return parent::getBlockContext($contextId);
	}

	/**
	 * Determine the plugin sequence. Overrides parent so that
	 * the plugin will be displayed during install.
	 *
	 * @param $contextId int Context ID (journal/press)
	 */
	function getSeq($contextId = null) {
		if (!Config::getVar('general', 'installed')) return 3;
		return parent::getSeq($contextId);
	}

	/**
	 * Get the display name of this plugin.
	 * @return String
	 */
	function getDisplayName() {
		return __('plugins.block.flagLanguageToggleBlock.displayName');
	}

	/**
	 * Get a description of the plugin.
	 */
	function getDescription() {
		return __('plugins.block.flagLanguageToggleBlock.description');
	}

	/**
	 * Get the HTML contents for this block.
	 * @param $templateMgr object
	 * @param $request PKPRequest
	 */
	
	function getContents($templateMgr, $request = null){

		
		/*------- TENTATIVA DE COLOCAR CSS NO TEMPLEATEMNGR -----------*/
		// $base_url = Config::getVar('general','base_url');
		// $css = $base_url . '/' . $this->getPluginPath() . '/flagToggle.css';
		// var_dump($css);
		// $templateMgr->addStyleSheet('flagToggle',$css, ["inline" => true]);
	
		$templateMgr->assign('path', $this->flagPath);

		$templateMgr->assign('isPostRequest', $request->isPost());
		if (!defined('SESSION_DISABLE_INIT')) {
			$journal = $request->getJournal();
			if (isset($journal)) {
				$locales = $journal->getSupportedLocaleNames();

			} else {
				$site = $request->getSite();
				$locales = $site->getSupportedLocaleNames();
			}
		} else {
			$locales = AppLocale::getAllLocales();
			$templateMgr->assign('languageToggleNoUser', true);
		}

		if (isset($locales) && count($locales) > 1) {
			$templateMgr->assign('enableLanguageToggle', true);
			$templateMgr->assign('languageToggleLocales', $locales); 
		}

		return parent::getContents($templateMgr, $request);
	}
}


