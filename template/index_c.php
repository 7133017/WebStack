{* Template Name: 首页数据 *}
{php}
$targetCategoryIDs = array_map('intval', explode(',', $zbp->Config('df_webstack')->homepage_categories ?? ''));

// 遍历目标分类ID列表
foreach ($categories as $category) {
    // 跳过不在目标分类ID列表中的分类
    if (!in_array($category->ID, $targetCategoryIDs)) continue;

    // 输出分类标题
    echo sprintf('<h4 class="text-gray"><i class="linecons-tag" id="%s"></i>%s</h4>', htmlspecialchars($category->Name), htmlspecialchars($category->Name));
    echo '<div class="row">';

    // 获取当前分类的文章
    $articles = $zbp->GetArticleList(
        '*',
        array(
            array('=', 'log_CateID', $category->ID), 
            array('=', 'log_Status', 0)
        ),
        array('log_PostTime' => 'DESC'),
        $zbp->Config('df_webstack')->category_nav_limit, // 数量限制
        null,
        false
    );

    // 遍历文章列表
    foreach ($articles as $article) {
        // 提取自定义字段
        $websiteName = htmlspecialchars($article->Metas->website_name ?? $article->Title);
        $websiteUrl = htmlspecialchars($article->Metas->website_url ?? $article->Url);
        $websiteDescription = htmlspecialchars($article->Metas->website_description ?? strip_tags($article->Intro));
        $websiteIcon = htmlspecialchars($article->Metas->website_icon ?? $host . 'zb_users/theme/' . $theme . '/style/images/favicon.png');

        // 使用模板字符串输出文章 HTML
        echo sprintf('
            <div class="col-sm-3">
                <div class="xe-widget xe-conversations box2 label-info" onclick="window.open(\'%s\', \'_blank\')" data-toggle="tooltip" data-placement="bottom" title="%s">
                    <div class="xe-comment-entry">
                        <a class="xe-user-img">
                            <img data-src="%s" class="lozad img-circle" width="40" alt="%s" src="%s" data-loaded="true">
                        </a>
                        <div class="xe-comment">
                            <a href="#" class="xe-user-name overflowClip_1"><strong>%s</strong></a>
                            <p class="overflowClip_2">%s</p>
                        </div>
                    </div>
                </div>
            </div>',
            $websiteUrl, $websiteUrl, $websiteIcon, $websiteName, $websiteIcon, $websiteName, $websiteDescription
        );
    }

    echo '</div><br><br>'; // 结束分类行
}
{/php}
