{*Template Name:内容页面模板*}
{template:header}
<body class="{$type}">
    <!-- skin-white -->
    <div class="page-container">
        <div class="sidebar-menu toggle-others fixed">
            {template:sidebar-menu}
        </div>
        <div class="main-content">
            {template:main-navbar}

            <h1>{$article.Title}</h1>

            {if $type=='article'}
                <a href="{$article.Category.Url}" target="_blank">{$article.Category.Name}</a> · 
                Py.<a href="{$article.Author.Url}" target="_blank">{$article.Author.StaticName}</a> · 
                {$article.Time("CreateTime","Y''m'd")}
            {/if}

            <br><br>

            <div class="xe-widget xe-conversations">
                {php}
                    // 检查文章是否有对应的自定义字段并输出
                    if ($article->Metas->website_name) {
                        echo '<p>网站名称：' . htmlspecialchars($article->Metas->website_name) . '</p>';
                    }

                    if ($article->Metas->website_keywords) {
                        echo '<p>关键词：' . htmlspecialchars($article->Metas->website_keywords) . '</p>';
                    }

                    if ($article->Metas->website_description) {
                        echo '<p>描述：' . htmlspecialchars($article->Metas->website_description) . '</p>';
                    }

                    if ($article->Metas->website_icon) {
                        echo '<p>ICO 图标：<img src="' . htmlspecialchars($article->Metas->website_icon) . '" alt="网站图标" width="40" height="40"></p>';
                    }

                    if ($article->Metas->website_url) {
                        echo '<p>网址：<a href="' . htmlspecialchars($article->Metas->website_url) . '" target="_blank">' . htmlspecialchars($article->Metas->website_url) . '</a></p>';
                    }
                {/php}

                {$article.Content}
            </div>

            <div class="commbox">
                {template:comments}
            </div>

            <footer class="main-footer sticky footer-type-1">
                {template:footer-inner}
            </footer>
        </div>
    </div>
{template:footer}