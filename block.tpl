{**
 * block.tpl
 *
 * Copyright (c) 2012-2012 Lepidus Tecnologia
 *
 * Based on http://pkp.sfu.ca/support/forum/viewtopic.php?f=28&t=5501
 *
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * $Id$
 *}
{if $enableLanguageToggle}
<div class="block" id="sidebarFlagLanguageToggle">
	<span class="blockTitle">{translate key="common.language"}</span>
	
	{foreach from=$languageToggleLocales key=langkey item=langname}
		{if $langkey == $currentLocale}
		    <img src="{$baseUrl}/{$plugin->getPluginPath()}/locale/{$langkey}/flag.png" alt="{$langname}" title="{$langname}" width="16" height="11" />
		{else}
			<a class="icon" href={if $languageToggleNoUser}'{$currentUrl|escape}{if strstr($currentUrl, '?')}&{else}?{/if}setLocale={$langkey}'{else}'{url page="user" op="setLocale" path=$langkey source=$smarty.server.REQUEST_URI escape=false}'{/if}>
	            <img src="{$baseUrl}/{$plugin->getPluginPath()}/locale/{$langkey}/flag.png" alt="{$langname}" title="{$langname}" width="16" height="11" />
			</a>
		{/if}
	{/foreach}
	
</div>
{/if}
