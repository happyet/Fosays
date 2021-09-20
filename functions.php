<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);

    $bgUrl = new Typecho_Widget_Helper_Form_Element_Text('bgUrl', NULL, NULL, _t('自定义背景图片地址'), _t('在这里填入一个图片 URL 地址, 以替换默认背景图片'));
    $form->addInput($bgUrl);

    $siteNotes = new Typecho_Widget_Helper_Form_Element_Textarea('siteNotes', NULL, NULL, _t('网站公告'), _t('首页导航底部公告，一行一个公告，支持html，太多不美观。'));
    $form->addInput($siteNotes);

    $ICPbei = new Typecho_Widget_Helper_Form_Element_Text('ICPbei', NULL, NULL, _t('ICP 备案号'), _t(''));
    $form->addInput($ICPbei);
    
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    array('ShowRecentPosts' => _t('显示最新文章'),
    'ShowRecentComments' => _t('显示最近回复'),
    'ShowCategory' => _t('显示分类'),
    'ShowArchive' => _t('显示归档'),
    'ShowOther' => _t('显示其它杂项')),
    array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'), _t('侧边栏显示'));
    
    $form->addInput($sidebarBlock->multiMode());
}
/*文章阅读次数统计*/
function get_post_view($archive) {
    $cid = $archive->cid;
    $db = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
        if (empty($views)) {
            $views = array();
        } else {
            $views = explode(',', $views);
        }
        if (!in_array($cid, $views)) {
            $db->query($db->update('table.contents')->rows(array('views' => (int)$row['views'] + 1))->where('cid = ?', $cid));
            array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
        }
    }
    $pViews = $row['views'];
    if($pViews > 1000){
        $pViews = number_format($pViews/1000,2) . 'K';
    }else{
        $pViews = number_format($pViews);
    }
    echo $pViews;
}
/* 通过邮箱生成头像地址 */
function get_avatar($mail,$size){
	$options = Typecho_Widget::widget('Widget_Options');
	$avatar_cdn = '//cravatar.cn/avatar/';
	$rating = Helper::options()->commentsAvatarRating;
	$mailLower = strtolower($mail);
	$md5MailLower = md5($mailLower);
    $reg='/^([0-9]{5,11})@qq.com$/';
    if(preg_match($reg,$mailLower)){
        $qq = str_replace('@qq.com', '', $mailLower);
        $qqapi = 'https://ptlogin2.qq.com/getface?&imgtype=1&uin='.$qq;
        $qquser = file_get_contents($qqapi);
        $str1 = explode('sdk&k=', $qquser);
        $str2 = explode('&s=', $str1[1]);
        $k = $str2[0]; //获取到的 K 码
        $avatar_link = '//q1.qlogo.cn/g?b=qq&k='.$k.'&s=100';
    } else {
		$avatar_link = $avatar_cdn . $md5MailLower . '?s='.$size.'&r='.$rating.'&d=mm';
	}
    return '<img src="'.$avatar_link.'" alt="avatar" class="avatar" />';
}
