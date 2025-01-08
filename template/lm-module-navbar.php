<li class="{$id}-item{if count($item.subs)} has-sub{/if}">
<a href="{$item.href}"{if $item.target} target="{$item.target}"{/if}{if $item.title} title="{$item.title}"{/if}{if !$item.target} class="smooth"{/if}>{$item.ico}<span class="title">{$item.text}</span></a>
  {if count($item.subs)}
  <ul>{foreach $item.subs as $item}{template:lm-module-defend}{/foreach}</ul>
  {/if}
</li>