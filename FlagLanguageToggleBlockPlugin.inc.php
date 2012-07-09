<?php

/**
 * @file FlagLanguageToggleBlockPlugin.inc.php
 *
 * Copyright (c) 2003-2012 John Willinsky
 * Contributed by from by Lepidus Tecnologia
 * 
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class FlagLanguageToggleBlockPlugin
 * @ingroup plugins_blocks_flagLanguageToggle
 *
 * @brief Class for language selector block plugin
 */

// $Id$


import('lib.pkp.classes.plugins.BlockPlugin');

class FlagLanguageToggleBlockPlugin extends BlockPlugin {
	/**
	 * Determine whether the plugin is enabled. Overrides parent so that
	 * the plugin will be displayed during install.
	 */
	function getEnabled() {
		if (!Config::getVar('general', 'installed')) return true;
		return parent::getEnabled();
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
	 * @return int
	 */
	function getBlockContext() {
		if (!Config::getVar('general', 'installed')) return BLOCK_CONTEXT_RIGHT_SIDEBAR;
		return parent::getBlockContext();
	}

	/**
	 * Determine the plugin sequence. Overrides parent so that
	 * the plugin will be displayed during install.
	 */
	function getSeq() {
		if (!Config::getVar('general', 'installed')) return 2;
		return parent::getSeq();
	}

	/**
	 * Get the display name of this plugin.
	 * @return String
	 */
	function getDisplayName() {
		return __('plugins.block.flagLanguageToggle.displayName');
	}

	/**
	 * Get a description of the plugin.
	 */
	function getDescription() {
		return __('plugins.block.flagLanguageToggle.description');
	}

	/**
	 * Get the HTML contents for this block.
	 */
	function getContents(&$templateMgr) {
		$templateMgr->assign('isPostRequest', Request::isPost());
		if (!defined('SESSION_DISABLE_INIT')) {
			$journal =& Request::getJournal();
			if (isset($journal)) {
				$locales =& $journal->getSupportedLocaleNames();

			} else {
				$site =& Request::getSite();
				$locales =& $site->getSupportedLocaleNames();
			}
		} else {
			$locales =& AppLocale::getAllLocales();
			$templateMgr->assign('languageToggleNoUser', true);
		}

		if (isset($locales) && count($locales) > 1) {
			$templateMgr->assign('enableLanguageToggle', true);
			$templateMgr->assign('languageToggleLocales', $locales);
			$templateMgr->assign('plugin', $this);
		}

		return parent::getContents($templateMgr);
	}
}

?>
