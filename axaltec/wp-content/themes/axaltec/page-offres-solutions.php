<?php
/*
Template Name: SOLUTIONS
*/

get_header(); 
$couleur_theme = cagetorie_parent();
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

					<?php if (has_post_thumbnail() ) : ?>
						<!-- Header de l'article -->
						<header class="entry-header">

							<!-- Le post thumbnail -->
							<div class="row post-metas">
								<div class="col-md-12">
									<div class="post-thumbnail">
										<?php  the_post_thumbnail("large"); ?>
									</div>
								</div>
							</div>

						</header>
					<?php endif; ?>
					
					<!-- Contenu de l'article -->
					<div class="entry-content">
						<div class="row">
							<div class="col-md-10 center-block">
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<!-- footer de l'article ( articles similaires ) -->
				<footer class="nos-refs nos-clients">
					
						<h3 class="o_sans c_bleu relatif"> Nos clients </h3>
						<div class="row grid">
							<div class="col-md-11 center-block">
								<div class="col-md-3">
									 <img src="<?php bloginfo('template_url'); ?>/assets/images/uploads/logo_materis.jpg" class="img-responsive">
								</div>
								<div class="col-md-3">
									<img src="<?php bloginfo('template_url'); ?>/assets/images/uploads/logo_allibert.jpg" class="img-responsive">
								</div>
								<div class="col-md-3">
									<img src="<?php bloginfo('template_url'); ?>/assets/images/uploads/logo_ingelec.jpg" class="img-responsive">
								</div>
								<div class="col-md-3">
									<img src="<?php bloginfo('template_url'); ?>/assets/images/uploads/logo_paulstra.jpg" class="img-responsive">
								</div>
							</div>
						</div>
						<div class="row grid">
							<div class="col-md-11 center-block">
								<div class="col-md-3">
									 <img src="<?php bloginfo('template_url'); ?>/assets/images/uploads/logo_materis.jpg" class="img-responsive">
								</div>
								<div class="col-md-3">
									<img src="<?php bloginfo('template_url'); ?>/assets/images/uploads/logo_allibert.jpg" class="img-responsive">
								</div>
								<div class="col-md-3">
									<img src="<?php bloginfo('template_url'); ?>/assets/images/uploads/logo_ingelec.jpg" class="img-responsive">
								</div>
								<div class="col-md-3">
									<img src="<?php bloginfo('template_url'); ?>/assets/images/uploads/logo_paulstra.jpg" class="img-responsive">
								</div>
							</div>
						</div>
					
				</footer>
			</article>
		</div>
		<!-- ici commence le sidebar -->
		<div id="sidebar" class="col-md-3">
			<?php get_sidebar(); ?>
		</div>
	</div>

		<?php 
			$offres = switch_offres();
			echo $offres;
			switch ($offres) {
				case '120':
					get_template_part("includes/offres");
					break;
				case '132':
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