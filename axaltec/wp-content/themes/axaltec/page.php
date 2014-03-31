<?php

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
							<span class="b_bleu rarr"> &rarr; </span>
						</div>
						<div class="col-md-10">
							<span class="lato">
								<?php 
									$get_titre = get_the_title();
									echo preg_replace("/\([^)]+\)/","",$get_titre);
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
				
				<?php
					/*============= NOS CLIENTS 
					@ includes/nos-clients.php
					*/
					/*if(is_page(array(4,10))) */
						

					if(is_page(10))
						get_template_part("includes/nos","clients");
					
						
						 
				?>
				
			</article>
		</div>
		
		<div id="sidebar" class="col-md-3">
			<?php 
			/*============= NOS CLIENTS 
			@ sidebar.php
			*/
			get_sidebar(); ?>
		</div>

	</div>
	
		<?php 
			/*============= NOS CLIENTS 
			@ (int) offres
			@ includes/offres.php
			@ includes/solutions.php
			*/
			$offres = switch_offres();
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

</div>


<?php get_footer(); ?>