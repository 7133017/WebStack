{* Template Name:列表页数据 *}
            {if $type=='article'}
            <h4 class="text-gray"><i class="linecons-tag" id="{$category.Name}"></i>{$category.Name}</h4>
            {elseif $type=='author'}
            <h4 class="text-gray"><i class="linecons-tag" id="{$author.StaticName}"></i>{$author.StaticName}</h4>
            {/if}
            <div class="row">
            {foreach $articles as $article}
                {php}
                // 提取自定义字段
                $websiteName = htmlspecialchars($article->Metas->website_name ?? $article->Title);
                $websiteUrl = htmlspecialchars($article->Metas->website_url ?? $article->Url);
                $websiteDescription = htmlspecialchars($article->Metas->website_description ?? strip_tags($article->Intro));
                $websiteIcon = htmlspecialchars($article->Metas->website_icon ?? ''.$host.'zb_users/theme/'.$theme.'/style/images/favicon.png');
                {/php}
                {if $article.TopType and $type != 'author'}
                <div class="col-sm-3">
                    <div class="xe-widget xe-conversations box2 label-info" onclick="window.open('{$websiteUrl}', '_blank')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="https://dribbble.com/">
                        <div class="xe-comment-entry">
                            <a class="xe-user-img">
                                <img data-src="{$websiteIcon}" class="lozad img-circle" width="40"alt="{$websiteName}">
                            </a>
                            <div class="xe-comment">
                                <a href="#" class="xe-user-name overflowClip_1">
                                    <strong>{$websiteName}</strong>
                                </a>
                                <p class="overflowClip_2">{$websiteDescription}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {else}
                <div class="col-sm-3">
                    <div class="xe-widget xe-conversations box2 label-info" onclick="window.open('{$websiteUrl}', '_blank')" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="https://dribbble.com/">
                        <div class="xe-comment-entry">
                            <a class="xe-user-img">
                                <img data-src="{$websiteIcon}" class="lozad img-circle" width="40"alt="{$websiteName}">
                            </a>
                            <div class="xe-comment">
                                <a href="#" class="xe-user-name overflowClip_1">
                                    <strong>{$websiteName}</strong>
                                </a>
                                <p class="overflowClip_2">{$websiteDescription}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {/if}
            {/foreach}
            </div>
            <div class="pagebar">{template:pagebar}</div>