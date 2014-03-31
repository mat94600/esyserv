	<footer class="b_gris">
		<div class="container relatif">
			<div class="center-block">
				<?php wp_nav_menu( array( 'theme_location' => 'Bottom' ) ); ?>
			</div>
			<div class="logo_footer">
				<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('template_url'); ?>/assets/images/logo_footer.png"></a>
			</div>
			<div class="social_footer">
				<a href="<?php echo get_option('linkedin'); ?>" title="<?php bloginfo('name'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/linkedin.png"></a>
				<a href="<?php echo get_option('viadeo'); ?>" title="<?php bloginfo('name'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/viadeo.png"></a>
			</div>
			<div clas="relatif">
				<div class="copyright absolue"> &copy;2014 Axaltec</div>
				<div class="adr absolue"> 46 rue Pierre Curie, 95210 Saint-Gratien</div>
				<div class="designby absolue"> Site realisé par e-sysoft </div>
			</div>
		</div>
	</footer>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="<?php bloginfo("template_url");?>/assets/js/config.js"></script>
    <script src="<?php bloginfo("template_url");?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php bloginfo("template_url");?>/assets/js/bjqs-1.3.min.js"></script>
  </body>
</html>