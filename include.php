<?php
RegisterPlugin('df_webstack', 'ActivePlugin_df_webstack');


function ActivePlugin_df_webstack() {
    Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu', 'df_webstack_AddMenu');  // 添加到topmenu
    // 显示表单
    Add_Filter_Plugin('Filter_Plugin_Edit_Response4', 'df_webstack_include');
    // 处理解析和上传请求
    if (isset($_POST['action']) && $_POST['action'] === 'parse') {
        df_webstack_parse();
        exit;
    } elseif (isset($_POST['action']) && $_POST['action'] === 'upload') {
        df_webstack_upload();
        exit;
    }
}

function df_webstack_AddMenu( & $m ) {
    global $zbp;
    $m[] = MakeTopMenu( "root", "主题配置", $zbp->host . "zb_users/theme/df_webstack/main.php", "", "topmenu_df_webstack", "icon-grid-1x2-fill" );
  }

// 显示表单
function df_webstack_include() {
    global $zbp, $article;
    $website_url = $article->Metas->website_url ?? '';
    $website_name = $article->Metas->website_name ?? '';
    $website_keywords = $article->Metas->website_keywords ?? '';
    $website_description = $article->Metas->website_description ?? '';
    $website_icon = $article->Metas->website_icon ?? '';
    ?>
    <script>
        function parseWebsite() {
            var url = $('#website_url').val();
            if (!url) {
                alert('请填写网址！');
                return;
            }

            $('.df_pars').text('解析中...');

            $.post('', { action: 'parse', url: url }, function (response) {
                if (response.success) {
                    // 填充自定义表单字段
                    $('#website_name').val(response.name);
                    $('#website_keywords').val(response.keywords);
                    $('#website_description').val(response.description);
                    $('#website_icon').val(response.icon);
                    $('#icon_preview').attr('src', response.icon).show();

                    // 填充到 Z-BLOG 的输入字段
                    $('#edtTitle').val(response.name || '未命名'); // 网站名称
                    $('#edtTag').val(response.keywords || ''); // 关键词
                    $('#edtAlias').val(response.domain.replace(/^https?:\/\//, '') || ''); // 去掉 http/https 的域名
                    // 使用 UEditor API 设置正文内容
                    var editor = window.parent.UE.instants['ueditorInstant0']; // 获取编辑器实例
                    if (editor) {
                        editor.setContent(response.description || ''); // 设置正文内容
                    }
                    $('.df_pars').text('解析');
                } else {
                    $('.df_pars').text('解析');
                    alert('解析失败：' + response.message + '，请手动录入');
                }
            }, 'json');
        }


        function uploadIcon(input) {
            var formData = new FormData();
            formData.append('action', 'upload');
            formData.append('file', input.files[0]);

            $.ajax({
                url: '', // 当前页面 URL 处理上传
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json', // 确保解析返回 JSON
                success: function(response) {
                    if (response.success) {
                        $('#website_icon').val(response.url);
                        $('#icon_preview').attr('src', response.url).show();
                    } else {
                        alert('上传失败：' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('上传失败：' + error);
                }
            });
        }

        $(document).ready(function() {
            var iconPreviewSrc = $('#icon_preview').attr('src');

            if (iconPreviewSrc && iconPreviewSrc.trim() !== '') { // 检查src属性是否存在且不为空字符串
                $('#icon_preview').show();
            } else {
                $('#icon_preview').hide();
            }
        });
        
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('df_webstack_form');
            const formHeader = document.getElementById('df_webstack_form_header');
            const toggleBtn = document.getElementById('toggle_form_btn');

            // 获取本地存储的状态
            const isHidden = localStorage.getItem('df_webstack_form_hidden') === 'true';

            // 初始化表单显示状态
            if (isHidden) {
                form.style.display = 'none';
                toggleBtn.textContent = '展开↓';
            }

            // 切换显示状态的逻辑
            toggleBtn.addEventListener('click', function () {
                const isCurrentlyHidden = form.style.display === 'none';
                if (isCurrentlyHidden) {
                    form.style.display = 'block';
                    toggleBtn.textContent = '收起↑';
                    localStorage.setItem('df_webstack_form_hidden', 'false');
                } else {
                    form.style.display = 'none';
                    toggleBtn.textContent = '展开↓';
                    localStorage.setItem('df_webstack_form_hidden', 'true');
                }
            });
        });
    </script>
    <style>
    .df_title{font-size:1.05em;font-weight:700}#df_webstack_form_header{display:flex;align-items:center;margin:0}#toggle_form_btn{font-size:12px;padding:5px 10px;margin-left:10px;background-color:azure}#df_webstack_form{display:block;padding:15px;background-color:azure;margin-bottom:30px}.df_lib{margin:10px 0}.df_lib label{font-weight:600;display:block;margin-bottom:5px}.df_lib input{padding:0 10px;line-height:1.8em;height:33px;font-size:1.2em}.df_lib textarea{padding:0 10px;line-height:1.8em;min-height:66px}.df_pars{font-weight:600;padding:6px 20px;cursor:pointer}.df_fah{display:flex;align-items:center}#icon_upload_wrapper{position:relative;width:40px;height:40px;margin-left:5px;border-radius:50%;background-color:#f0f0f0;border:1px solid #ccc;cursor:pointer;overflow:hidden}#icon_upload_wrapper:hover{transition:all .2s ease-in-out;border:1px solid #38f;transform:scale(1.2)}#icon_preview{position:absolute;width:100%;height:100%;object-fit:cover;background: #fff;border-radius:50%;display:none;z-index:1}#upload_symbol{position:absolute;font-size:26px;font-weight:700;color:#999;pointer-events:none}#website_icon_upload{position:absolute;left:0;height:100%;opacity:0;cursor:pointer;z-index:2}
    </style>
    <div id="df_webstack_form_header">
        <label class="df_title">网址导航表单</label>
        <a href="#" id="toggle_form_btn">收起↑</a>
    </div>
    <div id="df_webstack_form">
        <div class="df_lib">
        <label for="website_url">网址：</label>
        <input type="text" id="website_url" name="meta_website_url" style="width: 70%;" value="<?php echo htmlspecialchars($website_url); ?>" placeholder="http" />
        <button type="button" class="df_pars" onclick="parseWebsite()">自动解析</button>
        </div>
        <div class="df_lib">
        <label for="website_name">网站名称：</label>
        <input type="text" id="website_name" name="meta_website_name" style="width: 70%;" value="<?php echo htmlspecialchars($website_name); ?>">
        </div>
        <div class="df_lib">
        <label for="website_keywords">关键词：</label>
        <input type="text" id="website_keywords" name="meta_website_keywords" style="width: 70%;" value="<?php echo htmlspecialchars($website_keywords); ?>">
        </div>
        <div class="df_lib">
        <label for="website_description">描述：</label>
        <textarea id="website_description" name="meta_website_description" style="width: 70%;"><?php echo htmlspecialchars($website_description); ?></textarea>
        </div>
        <div class="df_lib">
            <label for="website_icon">ICO 图标：</label>
            <div class="df_fah">
            <input type="text" id="website_icon" name="meta_website_icon" style="width: 70%;" value="<?php echo htmlspecialchars($website_icon); ?>">
            <div id="icon_upload_wrapper" title="上传ICO图标">
                <img id="icon_preview" src="<?php echo htmlspecialchars($website_icon); ?>" alt="Website Icon">
                <span id="upload_symbol">Up</span>
                <input type="file" id="website_icon_upload" onchange="uploadIcon(this)">
            </div>
            </div>
        </div>
    </div>
    <?php
}

// 保存表单数据到文章对象
function df_webstack_save_meta(&$article) {
    $article->Metas->website_url = $_POST['meta_website_url'] ?? '';
    $article->Metas->website_name = $_POST['meta_website_name'] ?? '';
    $article->Metas->website_keywords = $_POST['meta_website_keywords'] ?? '';
    $article->Metas->website_description = $_POST['meta_website_description'] ?? '';
    $article->Metas->website_icon = $_POST['meta_website_icon'] ?? '';
}

// 保存文章时写入数据库
function df_webstack_save_to_db(&$article) {
    global $zbp;
    $article->Save();
}

// 解析功能
function df_webstack_parse() {
    global $zbp;

    $url = filter_var($_POST['url'] ?? '', FILTER_VALIDATE_URL);
    if (!$url) {
        echo json_encode(['success' => false, 'message' => '无效的URL']);
        return;
    }

    // 获取页面内容
    $content = @file_get_contents($url);
    if (!$content) {
        echo json_encode(['success' => false, 'message' => '无法获取页面内容']);
        return;
    }

    // 提取 <title>
    preg_match('/<title>(.*?)<\/title>/is', $content, $matches);
    $title = $matches[1] ?? '未找到标题';

    // 提取 meta 信息
    $tags = get_meta_tags($url);

    // 获取图标 URL
    $iconUrl = df_webstack_get_icon_url($content, $url);

    // 本地化图标
    $localIconPath = $iconUrl ? df_webstack_download_icon($iconUrl) : '';

    // 构造响应数据
    echo json_encode([
        'success' => true,
        'name' => $title,
        'domain' => parse_url($url, PHP_URL_HOST),
        'keywords' => $tags['keywords'] ?? '',
        'description' => $tags['description'] ?? '',
        'icon' => $localIconPath,
    ]);
}

/**
 * 获取网站的 ICO 图标 URL
 *
 * @param string $content 网站 HTML 内容
 * @param string $baseUrl 网站的基础 URL
 * @return string|null 图标 URL 或 null
 */
function df_webstack_get_icon_url($content, $baseUrl) {
    // 从 HTML 提取 <link rel="icon"> 或 <link rel="shortcut icon">
    if (preg_match('/<link[^>]+rel=["\'](?:shortcut )?icon["\'][^>]+href=["\']([^"\']+)["\']/i', $content, $matches)) {
        $iconUrl = $matches[1];
        // 如果是相对路径，将其转换为绝对路径
        if (!preg_match('/^https?:\/\//i', $iconUrl)) {
            $parsedBase = parse_url($baseUrl);
            $iconUrl = rtrim($parsedBase['scheme'] . '://' . $parsedBase['host'], '/') . '/' . ltrim($iconUrl, '/');
        }
        return $iconUrl;
    }

    // 回退到 /favicon.ico
    $parsedUrl = parse_url($baseUrl);
    return $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . '/favicon.ico';
}

/**
 * 下载并保存 ICO 图标到本地
 *
 * @param string $iconUrl ICO 图标的 URL
 * @return string 本地存储的图标 URL 或空字符串
 */
function df_webstack_download_icon($iconUrl) {
    global $zbp;

    // 检查并创建存储目录
    $uploadDir = $zbp->path . 'zb_users/theme/df_webstack/style/images/icons/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // 下载 ICO 图标
    $iconData = @file_get_contents($iconUrl);
    if ($iconData === false) {
        return ''; // 下载失败，返回空
    }

    // 确定保存路径和 URL
    $fileExtension = pathinfo($iconUrl, PATHINFO_EXTENSION) ?: 'ico';
    $filename = uniqid('icon_') . '.' . $fileExtension;
    $localFilePath = $uploadDir . $filename;

    // 保存文件到本地
    if (file_put_contents($localFilePath, $iconData) !== false) {
        return $zbp->host . 'zb_users/theme/df_webstack/style/images/icons/' . $filename;
    }

    return '';
}


// 上传功能
function df_webstack_upload() {
    global $zbp;

    // 检查是否有文件上传
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        $error_message = '';
        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $error_message = '文件大小超过了允许的限制';
                break;
            case UPLOAD_ERR_NO_FILE:
                $error_message = '没有文件被上传';
                break;
            case UPLOAD_ERR_PARTIAL:
                $error_message = '文件上传不完整';
                break;
            default:
                $error_message = '文件上传失败';
        }
        echo json_encode(['success' => false, 'message' => $error_message]);
        return;
    }

    // 确定上传目录
    $uploadDir = $zbp->path . 'zb_users/theme/df_webstack/style/images/icons/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // 确定文件存储路径
    $file = $_FILES['file'];
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, ['ico', 'png', 'jpg', 'jpeg'])) {
        echo json_encode(['success' => false, 'message' => '不支持的文件格式，请上传 ICO 或图片文件']);
        return;
    }

    // 限制文件大小（例如：限制为2MB）
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    if ($file['size'] > $maxFileSize) {
        echo json_encode(['success' => false, 'message' => '文件大小不能超过 2MB']);
        return;
    }

    $filename = uniqid() . '.' . $extension;
    $filepath = $uploadDir . $filename;

    // 移动上传的文件
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        echo json_encode([
            'success' => true,
            'url' => $zbp->host . 'zb_users/theme/df_webstack/style/images/icons/' . $filename,
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => '文件保存失败']);
    }
}

?>
