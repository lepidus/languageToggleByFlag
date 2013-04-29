<?php

/**
 * @file FlagLanguageToggleBlockPlugin.inc.php
 *
 * Copyright (c) 2012-2012 Lepidus Tecnologia
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
		$path = Request::getBaseUrl() . '/' . $this->getPluginPath() . '/flagToggle.css';
		$templateMgr->addStyleSheet($path);

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
