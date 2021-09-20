<?php
/**
 * Typecho 单栏主题。
 * 
 * @package Fosays 
 * @author LMS
 * @version 2.0
 * @link https://lms.im/theme/typecho-theme-fosays.html
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>

<main id="main" role="main">
	<div class="container">
		<?php $site_notes = $this->options->siteNotes;
			if($site_notes){
				echo '<div id="site-notes"><ul>';
					$notes_array = explode("\r\n", $site_notes);
					foreach($notes_array as $note){
						echo '<li>'.$note.'</li>';
					}
				echo '</ul></div>';
			}
		?>
		<?php while($this->next()): ?>
			<article class="post" itemscope itemtype="http://schema.org/BlogPosting">
				<h2 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
				<ul class="post-meta">
					<li itemprop="author" itemscope itemtype="http://schema.org/Person"><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php echo get_avatar($this->author->mail,28); ?> <?php $this->author(); ?></a></li>
					<li><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
					<li><?php get_post_view($this); ?> 阅</li>
					<li itemprop="interactionCount"><a itemprop="discussionUrl" href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0 评', '1 评', '%d 评'); ?></a></li>
				</ul>
				<div class="post-content" itemprop="articleBody">
					<?php $this->content('- 阅读剩余部分 -'); ?>
				</div>
				<footer class="post-footer">
					<?php $this->category(' '); ?>
					<?php $this->tags(' ', true, ''); ?>
				</footer>
			</article>
		<?php endwhile; ?>

		<?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
	
	<?php $this->need('sidebar.php'); ?>
	</div>
</main>
<?php $this->need('footer.php'); ?>
