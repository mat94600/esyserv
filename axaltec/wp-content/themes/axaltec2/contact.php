<?php
	/*
	Template Name: Contact
	*/
	get_header(); 
?>
<div class="container">
	<div class="general row">
		<div id="post-content" class="col-md-9">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">

				<?php while ( have_posts() ) : the_post(); ?>
					<div class="row cat-title">
						<div class="col-md-2">
							<span class="<?php echo $couleur_theme; ?> rarr"> &rarr; </span>
						</div>
						<div class="col-md-10">
							<span class="lato"><?php the_title(); ?></span>
						</div>
					</div>
					<div id="contactMap">
						<?php echo do_shortcode('[vsgmap address="'.get_option( 'google_maps').'"]');?>
					</div>
					<!-- Contenu de l'article -->
					<div class="entry-content">

						<?php the_content(); ?>
						<!--div class="row">
							<div class="col-md-12">
								<h3 class="o_sans c_bleu relatif"> Responsable business unit </h3>
								<div class="col-md-11 center-block floatNone">
									<div class="col-md-4">
										<strong>Jean Christophe Abert</strong><br>
										Tél : 33(0)6 21 25 42 15<br><br>
										Email : jcaber@exaltec.com
									</div>
									<div class="col-md-4">
										Jean Christophe Abert<br>
										Tél : 33(0)6 21 25 42 15<br><br>
										Email : jcaber@exaltec.com
									</div>
									<div class="col-md-4">
										Jean Christophe Abert<br>
										Tél : 33(0)6 21 25 42 15<br><br>
										Email : jcaber@exaltec.com
									</div>
								</div>
							</div>
						</div-->
					</div>
				<?php endwhile; ?>
				<!-- footer de l'article ( articles similaires ) -->
				<footer class="nos-refs nos-clients">
					
					
				</footer>
			</article>
		</div>
		<!-- ici commence le sidebar -->
		<div id="sidebar" class="col-md-3">
			<?php get_sidebar(); ?>
		</div>
	</div>
	
		<?php 
			$show_offres =  show_offres();
			switch ($show_offres) {
				case 'solutions':
					get_template_part("includes/offres");
					break;
				case 'offres':
					get_template_part("includes/solutions");
					break;
				default:
					get_template_part("includes/offres");
					break;
			}
		?>
	
	<?php //get_template_part("includes/solutions"); ?>
</div>


<?php get_footer(); ?>