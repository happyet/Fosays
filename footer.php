<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<footer id="footer" role="contentinfo">
    <p>&copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
    <?php _e('Powered by <a href="http://www.typecho.org" target="_blank">Typecho</a>'); ?>. <?php echo $this->options->ICPbei ? $this->options->ICPbei : ''; ?><br>
    主题制作 <a href="https://lms.im" targe="_blank">LMS</a></p>
</footer>
<div id="back-top" class="back-top">返回<br>顶部</div>
<script src="<?php $this->options->themeUrl('js/app.js'); ?>"></script>
<?php $this->footer(); ?>
</body>
</html>
