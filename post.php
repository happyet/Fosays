<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main id="main" role="main">
	<div class="container">
        <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
            <h1 class="post-title" itemprop="name headline"><?php $this->title() ?></h1>
            <ul class="post-meta">
				<li itemprop="author" itemscope itemtype="http://schema.org/Person"><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php echo get_avatar($this->author->mail,28); ?> <?php $this->author(); ?></a></li>
				<li><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
				<li><?php get_post_view($this); ?> 阅</li>
				<li itemprop="interactionCount"><a itemprop="discussionUrl" href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0 评', '1 评', '%d 评'); ?></a></li>
			</ul>
            <div class="post-content" itemprop="articleBody">
                <?php $this->content(); ?>
            </div>
            <footer class="post-footer">
				<?php $this->category(' '); ?>
				<?php $this->tags(' ', true, ''); ?>
			</footer>
        </article>

        <?php $this->need('comments.php'); ?>

        <ul class="post-near">
            <li>上一篇 <?php $this->thePrev('%s','<span>没有了</span>'); ?></li>
            <li>下一篇 <?php $this->theNext('%s','<span>没有了</span>'); ?></li>
        </ul>
        <?php $this->need('sidebar.php'); ?>
    </div>
</main>
<?php $this->need('footer.php'); ?>
