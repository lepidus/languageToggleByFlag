<?php

/**
 * @file plugins/blocks/bandeiraIdiomaBlock/bandeiraIdiomaBlockPlugin.inc.php
 *
 * Copyright (c) 2014-2019 Simon Fraser University
 * Copyright (c) 2003-2019 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class BandeiraIdiomaBlockPlugin
 * @ingroup plugins_blocks_bandeiraIdioma
 *
 * @brief Class for language selector block plugin
 */

import('lib.pkp.classes.plugins.BlockPlugin');

class BandeiraIdiomaBlockPlugin extends BlockPlugin {
	/**
	 * Determine whether the plugin is enabled. Overrides parent so that
	 * the plugin will be displayed during install.
	 *
	 * @param $contextId int Context ID (journal/press)
	 * @return boolean
	 */

	// Função que é chamada logo ao iniciar o plugin
	function register($category, $path, $mainContextId = NULL) {
		$success = parent::register($category, $path);
		
		$request = Application::getRequest();
		$url = $request->getBaseUrl() . '/' . $this->getPluginPath() . '/flagToggle.css';
		$templateMgr = TemplateManager::getManager($request);
		$templateMgr->addStyleSheet('flagToggle', $url);
		
		return $success;
	}

	private $flagPath = "/plugins/blocks/bandeiraIdioma/locale/";

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
		return __('plugins.block.bandeiraIdiomaBlock.displayName');
	}

	/**
	 * Get a description of the plugin.
	 */
	function getDescription() {
		return __('plugins.block.bandeiraIdiomaBlock.description');
	}

	/**
	 * Get the HTML contents for this block.
	 * @param $templateMgr object
	 * @param $request PKPRequest
	 */

	function getContents($templateMgr, $request = null){

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


