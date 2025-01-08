{*Template Name:顶部通栏*}
            <nav class="navbar user-info-navbar">
                <!-- User Info, Notifications and Menu Bar -->
                <!-- Left links for user info navbar -->
                <ul class="user-info-menu left-links list-inline list-unstyled">
                    <li class="hidden-sm hidden-xs">
                        <a href="#" data-toggle="sidebar">
                            <i class="fa-bars"></i>
                        </a>
                    </li>
                    <li class="dropdown hover-line language-switcher">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{$host}zb_users/theme/{$theme}/style/images/flags/flag-cn.png" alt="flag-cn"> 
                        </a>
                        <ul class="dropdown-menu languages">
                        <li>
                            <a href="javascript:translate.changeLanguage('english');">
                                <img src="{$host}zb_users/theme/{$theme}/style/images/flags/flag-us.png" alt="flag-us"> English
                            </a>
                        </li>
                        <li class="active">
                            <a href="javascript:translate.changeLanguage('chinese_simplified');">
                                <img src="{$host}zb_users/theme/{$theme}/style/images/flags/flag-cn.png" alt="flag-cn"> Chinese
                            </a>
                        </li>
                        </ul>
                    </li>
                </ul>
                <ul class="user-info-menu right-links list-inline list-unstyled">
                    <li class="hidden-sm hidden-xs">
                        <a href="https://github.com/7133017/WebStack/" target="_blank">
                            <i class="fa-github"></i>  GitHub
                        </a>
                    </li>
                </ul>
            </nav>