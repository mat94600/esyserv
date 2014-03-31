<?php
/*
Template Name: My Custom Page
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
							<span class="lato">
								<?php 
									$titre = get_the_title();
									$titre_final = preg_replace("/\([^)]+\)/","",$titre); 
									echo $titre_final;
								?>
							</span>
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
	
</div>


<?php get_footer(); ?>