<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main id="main" role="main">
	<div class="container">
        <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
            <h1 class="post-title" itemprop="name headline"><?php $this->title() ?></h1>
            <div class="post-content" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
            <footer class="post-footer">
				<?php $this->category(' '); ?>
				<?php $this->tags(' ', true, ''); ?>
			</footer>
        </article>
        <?php $this->need('comments.php'); ?>
        <?php $this->need('sidebar.php'); ?>
    </div>
</main>
<?php $this->need('footer.php'); ?>
