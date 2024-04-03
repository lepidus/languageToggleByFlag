<?php

/**
 * @file plugins/blocks/languageToggleByFlagBlock/LanguageToggleByFlagPlugin.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Copyright (c) 2019-2024 Lepidus Tecnologia
 *
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class LanguageToggleByFlagPlugin
 * @ingroup plugins_blocks_languageToggleByFlag
 *
 * @brief Class for language selector by flag block plugin
 */

namespace APP\plugins\blocks\languageToggleByFlag;

use PKP\plugins\BlockPlugin;
use PKP\config\Config;

class LanguageToggleByFlagPlugin extends BlockPlugin
{
    public function getInstallSitePluginSettingsFile()
    {
        return $this->getPluginPath() . '/settings.xml';
    }

    public function getContextSpecificPluginSettingsFile()
    {
        return $this->getPluginPath() . '/settings.xml';
    }

    public function getSeq($contextId = null)
    {
        if (!Config::getVar('general', 'installed')) {
            return 3;
        }
        return parent::getSeq($contextId);
    }

    public function getDisplayName()
    {
        return __('plugins.block.languageToggleByFlag.displayName');
    }

    public function getDescription()
    {
        return __('plugins.block.languageToggleByFlag.description');
    }

    public function getContents($templateMgr, $request = null)
    {

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
