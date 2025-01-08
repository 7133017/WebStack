<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('df_webstack')) {$zbp->ShowError(48);die();}

$blogtitle = '主题设置 - df_webstack';

if (isset($_POST['save'])) {

    // 保存配置项
    $homepage_title = isset($_POST['homepage_title']) ? trim($_POST['homepage_title']) : '又一个X站';
    $homepage_keywords = isset($_POST['homepage_keywords']) ? trim($_POST['homepage_keywords']) : 'X,XX,XXX';
    $homepage_description = isset($_POST['homepage_description']) ? trim($_POST['homepage_description']) : '这不是埃隆·马斯克的X~';


    // 处理多选分类
    $homepage_categories = isset($_POST['homepage_categories']) ? $_POST['homepage_categories'] : [];
    $zbp->Config('df_webstack')->homepage_categories = implode(',', array_map('intval', $homepage_categories)); // 将分类数组转为逗号分隔的字符串

    $zbp->Config('df_webstack')->category_nav_limit = $_POST['category_nav_limit'] ?? '28';

    // 保存配置
    $zbp->SaveConfig('df_webstack');
    $zbp->SetHint('good', '设置已保存');
    Redirect('./main.php');
}

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>

<div id="divMain">
    <div class="divHeader">主题配置 - df_webstack</div>
    <div class="SubMenu"></div>
    <div id="divMain2">
        <form method="post">
            <input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken();?>">
            <table class="tableBorder" width="100%">
                <tr>
                    <th colspan="2"><b>首页配置</b></th>
                </tr>
                <tr>
                    <td width="15%"><label for="homepage_title">首页标题：</label></td>
                    <td><input type="text" name="homepage_title" id="homepage_title" value="<?php echo htmlspecialchars($zbp->Config('df_webstack')->homepage_title ?? '又一个X站'); ?>" style="width:98%;" /></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="15%"><label for="homepage_keywords">首页关键词：</label></td>
                    <td><input type="text" name="homepage_keywords" id="homepage_keywords" value="<?php echo htmlspecialchars($zbp->Config('df_webstack')->homepage_keywords ?? 'X,XX,XXX'); ?>" style="width:98%;" /></td>
                    <td></td>
                </tr>
                <tr>
                    <td width="15%"><label for="homepage_description">首页描述：</label></td>
                    <td><textarea name="homepage_description" id="homepage_description" style="width:98%;height:60px;"><?php echo htmlspecialchars($zbp->Config('df_webstack')->homepage_description ?? '这不是埃隆·马斯克的X~'); ?></textarea></td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row"><label for="homepage_categories">首页显示分类</label></th>
                    <td>
                        <select name="homepage_categories[]" id="homepage_categories" multiple="multiple" style="width: 100%; height: 200px;">
                            <?php foreach ($zbp->categorys as $category): ?>
                                <option value="<?php echo $category->ID; ?>" 
                                    <?php echo (in_array($category->ID, explode(',', $zbp->Config('df_webstack')->homepage_categories ?? ''))) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($category->Name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <td>按住 <strong>Ctrl</strong>（Windows）或 <strong>Command</strong>（Mac）可以多选分类。</td>
                    </td>
                </tr>

                <tr>
                    <td width="15%"><label for="category_nav_limit">分类导航数量最大值：</label></td>
                    <td><input type="number" name="category_nav_limit" id="category_nav_limit" value="<?php echo htmlspecialchars($zbp->Config('df_webstack')->category_nav_limit ?? '28'); ?>" style="width:98%;" /></td>
                    <td></td>
                </tr>
            </table>
            <input type="submit" name="save" class="button" value="保存设置" />
        </form>
    </div>
</div>
<script type="text/javascript">
ActiveTopMenu("topmenu_df_webstack");
</script>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>
