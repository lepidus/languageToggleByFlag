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
		    <div class="langFlag {$langkey}" alt="{$langname}" title="{$langname}"></div>
		{else}
			<a class="icon langFlag {$langkey}" href={if $languageToggleNoUser}'{$currentUrl|escape}{if strstr($currentUrl, '?')}&{else}?{/if}setLocale={$langkey}'{else}'{url page="user" op="setLocale" path=$langkey source=$smarty.server.REQUEST_URI escape=false}'{/if}>
			</a>
		{/if}
	{/foreach}
	
</div>
{/if}
