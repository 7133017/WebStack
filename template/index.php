{* Template Name:Index *}
{template:header}
<body class="{$type}">
    <!-- skin-white -->
    <div class="page-container">
        <div class="sidebar-menu toggle-others fixed">
            {template:sidebar-menu}
        </div>
        <div class="main-content">
            {template:main-navbar}

			{if $type=='index'&&$page=='1'} 
				{template:index_c}
			{else}
				{template:index_list}
			{/if}

			<footer class="main-footer sticky footer-type-1">
                {template:footer-inner}
            </footer>
        </div>
    </div>
{template:footer}