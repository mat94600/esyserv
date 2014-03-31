<?php
/*
Template Name: Presentation de la societe
*/
get_header(); 
$couleur_theme = cagetorie_parent();

?>

<div class="container">
	<div class="general row">
		<div id="post-content" class="col-md-9">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">
				<?php while ( have_posts() ) : the_post(); global $post; ?>
					<div class="row cat-title">
						<div class="col-md-2">
							<span class="<?php echo $couleur_theme; ?> rarr"> &rarr; </span>
						</div>
						<div class="col-md-10">
							<span class="lato"><?php the_title(); ?></span>
						</div>
					</div>

					<?php if ( has_post_thumbnail() ) : ?>
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
						
					<?php 
						/* includes > refs-interne.php */
						get_template_part("includes/refs","interne"); 
					?>
					
				</footer>
			</article>
		</div>
		<!-- ici commence le sidebar -->
		<div id="sidebar" class="col-md-3">
			<?php get_sidebar(); ?>
		</div>
	</div>

	<!-- Les 4 boutons en bas -->
	<section>
		<div class="univers row">
			<a href="#">
				<div class="col-md-3 relatif">
					<img class="img-responsive" src="<?php bloginfo("template_url"); ?>/assets/images/uploads/im.jpg">
					<div class="b_bleu lato absolue"> Conseil Métier </div>
				</div>
			</a>
			<a href="#">
				<div class="col-md-3 relatif">
					<img class="img-responsive" src="<?php bloginfo("template_url"); ?>/assets/images/uploads/im.jpg">
					<div class="b_violet lato absolue"> Intégration et optimisation </div>
				</div>
			</a>
			<a href="#">
				<div class="col-md-3 relatif">
					<img class="img-responsive" src="<?php bloginfo("template_url"); ?>/assets/images/uploads/im.jpg">
					<div class="b_bleu_c lato absolue"> Assistance à maîtrise d'ouvrage </div>
				</div>
			</a>
			<a href="#">
				<div class="col-md-3 relatif">
					<img class="img-responsive" src="<?php bloginfo("template_url"); ?>/assets/images/uploads/im.jpg">
					<div class="b_gris lato absolue"> tma </div>
				</div>
			</a>
		</div>
	</section>
</div>


<?php get_footer(); ?>