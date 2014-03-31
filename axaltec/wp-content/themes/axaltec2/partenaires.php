<?php
/*
Template Name: Partenaires
*/
get_header(); 
$couleur_theme = cagetorie_parent();

?>

<div class="container">
	<div class="general row">
		<div id="post-content" class="col-md-9">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">
				
					<div class="row cat-title">
						<div class="col-md-2">
							<span class="<?php echo $couleur_theme; ?> rarr"> &rarr; </span>
						</div>
						<div class="col-md-10">
							<span class="lato"> Partenaires </span>
						</div>
					</div>

					<!-- Contenu de l'article -->
					<div class="entry-content">
						<?php 
						$args = array(
							'post_type'=>'partenaires',
							'post_per_page'=>100
							);
						$query = new Wp_Query($args);
						while ( $query->have_posts() ) : $query->the_post(); global $post; ?>
						<!-- Partenaire -->
						<div class="row">
							<div class="col-md-4">
								<?php
									if(has_post_thumbnail()){

										the_post_thumbnail("large", array("class"=>"img-responsive"));

									} 
								?>
							</div>
							<div class="col-md-8">
								<h3><?php the_title(); ?></h3>
								<div class="chapeau">
									<?php 
										$chapeau    = get_post_meta($post->ID, 'wpcf-texte-daccroche', true);
										$site_web   = get_post_meta($post->ID, 'wpcf-web-partenaire', true);
										$lien_web   = get_post_meta($post->ID, 'wpcf-web-text', true);
										
										echo $chapeau;
									?>
								</div>
								<p>
									<?php the_content(); ?>
								</p>
								<div class="btn_bleu_carre">
									<a href="<?php echo $site_web; ?>" class="b_bleu" title="<?php the_title(); ?>" target="_blank">
										<?php echo $lien_web; ?>
									</a>
								</div>
							</div>
						</div>
						<?php endwhile; ?>
					</div>
				

			</article>
		</div>
		<!-- ici commence le sidebar -->
		<div id="sidebar" class="col-md-3">
			<?php get_sidebar(); ?>
		</div>
	</div>

	<!-- Les 4 boutons en bas -->
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