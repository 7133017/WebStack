{* Template Name:公共底部 *}
            <!--END UED团队 -->
            <!-- Main Footer -->
            <!-- Choose between footer styles: "footer-type-1" or "footer-type-2" -->
            <!-- Add class "sticky" to  always stick the footer to the end of page (if page contents is small) -->
            <!-- Or class "fixed" to  always fix the footer to the end of page -->

    <!-- 锚点平滑移动 -->
    <script src="{$host}zb_users/theme/{$theme}/script/loaded.js"></script>
    <!-- Bottom Scripts -->
    <script src="{$host}zb_users/theme/{$theme}/script/bootstrap.min.js"></script>
    <script src="{$host}zb_users/theme/{$theme}/script/TweenMax.min.js"></script>
    <script src="{$host}zb_users/theme/{$theme}/script/resizeable.js"></script>

    <script src="{$host}zb_users/theme/{$theme}/script/xenon-toggles.js"></script>
    <!-- JavaScripts initializations and stuff -->
    <script src="{$host}zb_users/theme/{$theme}/script/xenon-custom.js"></script>
    <script src="{$host}zb_users/theme/{$theme}/script/lozad.js"></script>
    <!-- Language -->
    <script src="{$host}zb_users/theme/{$theme}/script/translate.js"></script>
    <script>
        translate.selectLanguageTag.show = false; //不出现的select的选择语言
        translate.service.use('client.edge'); //设置翻译服务
        translate.execute();
        $(document).ready(function() {
        const $languageSwitcher = $('.language-switcher');
        const $langToggle = $languageSwitcher.find('.dropdown-toggle');
        const $langMenu = $languageSwitcher.find('.dropdown-menu');

        // Check stored language in localStorage
        const storedLang = localStorage.getItem('language') || 'chinese_simplified';
        const languageData = {
            english: {
                flag: '{$host}zb_users/theme/{$theme}/style/images/flags/flag-us.png',
                text: 'English'
            },
            chinese_simplified: {
                flag: '{$host}zb_users/theme/{$theme}/style/images/flags/flag-cn.png',
                text: 'Chinese'
            }
        };

        // Set initial language
        updateLanguage(storedLang);

        // Language change function
        function changeLanguage(lang) {
            localStorage.setItem('language', lang);
            updateLanguage(lang);
        }

        // Update language display
        function updateLanguage(lang) {
            const selectedLang = languageData[lang];
            $langToggle.find('img').attr('src', selectedLang.flag).attr('alt', lang);
            if ($langToggle.find('span').length) {
                $langToggle.find('span').text(selectedLang.text);
            } else {
                $langToggle.append(`<span>${selectedLang.text}</span>`);
            }

            // Set active class on the selected language
            $langMenu.find('li').removeClass('active');
            const $selectedItem = $langMenu.find(`a[href="javascript:translate.changeLanguage('${lang}');"]`).parent();
            $selectedItem.addClass('active');
        }

        // Add event listeners for language switching
        $langMenu.find('a').on('click', function() {
            const selectedLang = $(this).attr('href').match(/'(\w+)'/)[1];
            changeLanguage(selectedLang);
        });
        });

    </script>
</body>

</html>
