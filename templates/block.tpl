{**
 * plugins/blocks/languageToggle/block.tpl
 *
 * Copyright (c) 2014-2019 Simon Fraser University
 * Copyright (c) 2003-2019 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Common site sidebar menu -- language toggle.
 *}


<link rel="stylesheet" type="text/css" href="{$path}../flagToggle.css" />

{if $enableLanguageToggle}
<div class="pkp_block block_language">
	<span class="title">
		{translate key="common.language"}
	</span>

	<div class="content">
		<ul>
			{foreach from=$languageToggleLocales item=localeName key=localeKey}
				<li class="locale_{$localeKey|escape}{if $localeKey == $currentLocale} current{/if}" lang="{$localeKey|escape}">
					<a href="{url router=$smarty.const.ROUTE_PAGE page="user" op="setLocale" path=$localeKey source=$smarty.server.REQUEST_URI}">
						
						<span class="flagToggle {$localeKey}">
						&nbsp;
						</span>

						{$localeName}

					</a>
				</li>
			{/foreach}
		</ul>
	</div>
</div><!-- .block_language -->
{/if}
