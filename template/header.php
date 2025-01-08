{* Template Name:公共头部 *}
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="generator" content="{$zblogphp}">
    <meta name="theme-author" content="viggo & No.9527">
	{if $type=='index'&&$page=='1'&&$zbp->Config('df_webstack')->homepage_title} 
    <title>{$zbp->Config('df_webstack')->homepage_title;}</title>
	<meta name="keywords" content="{$zbp->Config('df_webstack')->homepage_keywords;}">
    <meta name="description" content="{$zbp->Config('df_webstack')->homepage_description;}">
	{else}
	<title>{$name}-{$title}</title>
	{/if}
    <link rel="shortcut icon" href="{$host}zb_users/theme/{$theme}/style/images/favicon.png">
	<link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/fonts/css.css">
    <link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/bootstrap.css">
    <link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/xenon-core.css">
    <link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/xenon-components.css">
    <link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/xenon-skins.css">
    <link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/nav.css">
	<link rel="stylesheet" href="{$host}zb_users/theme/{$theme}/style/style.css">
    <script src="{$host}zb_system/script/jquery-latest.min.js?v={$version}"></script>
	<script src="{$host}zb_system/script/zblogphp.js?v={$version}"></script>
	<script src="{$host}zb_system/script/c_html_js_add.php?{if isset($html_js_hash)}hash={$html_js_hash}&{/if}v={$version}"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	{if $type=='index'&&$page=='1'} 
    <!-- / FB Open Graph -->
    <meta property="og:type" content="article">
    <meta property="og:url" content="{$host}">
    <meta property="og:title" content="{$name}">
    <meta property="og:description" content="{$zbp->Config('df_webstack')->homepage_keywords;}">
    <meta property="og:image" content="{$host}zb_users/theme/{$theme}/style/images/webstack_banner_cn.png">
    <meta property="og:site_name" content="{$name}">
    <!-- / Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{$name}">
    <meta name="twitter:description" content="{$zbp->Config('df_webstack')->homepage_keywords;}">
    <meta name="twitter:image" content="{$host}zb_users/theme/{$theme}/style/images/webstack_banner_cn.png">
	{/if}
</head>