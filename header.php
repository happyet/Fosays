<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/normalize.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">
    <?php if ($this->options->bgUrl): ?>
        <style>body{background-image:url(<?php $this->options->bgUrl() ?>)}</style>
    <?php endif; ?>
    <?php $this->header(); ?>
</head>
<body>
<header id="header">
    <div class="container">
        <div class="site-header">
            <?php if ($this->options->logoUrl): ?>
                <a class="site-logo" href="<?php $this->options->siteUrl(); ?>">
                    <img src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>" />
                </a>
            <?php endif; ?>
            <h1><a class="site-name" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a></h1>
        	<?php if ($this->options->description): ?><p class="description"><?php $this->options->description() ?></p><?php endif; ?>
        </div>    
    </div>
</header>
<nav id="nav-menu" role="navigation">
        <div class="container">
            <ul class="menu">
                <li><a<?php if($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>
                <?php $this->widget('Widget_Metas_Category_List')->to($cats);?>
				<?php while ($cats->next()): ?>
					<li><a<?php echo ($this->is('category', $cats->slug)) ? ' class="current"' : ''; ?> href="<?php $cats->permalink()?>"><?php $cats->name()?></a></li>
				<?php endwhile; ?>
                <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                <?php while($pages->next()): ?>
                    <li><a<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
                <?php endwhile; ?>
                <li id="search-toggle" class="search-toggle"><a href="javascript:;"><img src="<?php $this->options->themeUrl('img/icon-search.png'); ?>" alt="search-icon"></a></li>
            </ul>
            <div id="site-search" class="site-search" style="display: none;">
                <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                    <input type="text" id="s" name="s" class="text" placeholder="<?php _e('输入关键字回车'); ?>" required />
                    <button type="submit" class="submit"><?php _e('搜索'); ?></button>
                </form>
            </div>
        </div>
    </nav>