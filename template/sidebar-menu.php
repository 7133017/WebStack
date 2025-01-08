{*Template Name:侧栏导航*}
            <div class="sidebar-menu-inner">
                <header class="logo-env">
                    <!-- logo -->
                    <div class="logo">
                        <a href="{$host}" title="{$name}" class="logo-expanded">
                            <img src="{$host}zb_users/theme/{$theme}/style/images/logo@2x.png" width="178" alt="{$name}">
                        </a>
                        <a href="index.html" title="{$name}" class="logo-collapsed">
                            <img src="{$host}zb_users/theme/{$theme}/style/images/logo-collapsed@2x.png" width="40" alt="{$name}">
                        </a>
                    </div>
                    <div class="mobile-menu-toggle visible-xs">
                        <a href="#" data-toggle="user-info-menu">
                            <i class="linecons-cog"></i>
                        </a>
                        <a href="#" data-toggle="mobile-menu">
                            <i class="fa-bars"></i>
                        </a>
                    </div>
                </header>
                <ul id="main-menu" class="main-menu">
					{module:navbar}
                </ul>
            </div>