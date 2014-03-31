<?php 
	get_header(); 
	$couleur_theme = cagetorie_parent();
	$categorie_parent = get_queried_object();
?>

<div class="container">
	<div class="general row">
		<div id="post-content" class="col-md-9">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">

				<?php $n = 0; while ( have_posts() ) : the_post(); ?>
				<?php if($n == '0') { ?>
					<div class="row cat-title">
						<div class="col-md-2">
							<span class="<?php echo $couleur_theme; ?> rarr"> &rarr; </span>
						</div>
						<div class="col-md-10">
							<span class="lato"><?php echo $categorie_parent->name; ?></span>
						</div>
					</div>

					<!-- Header de l'article -->
					<header class="entry-header">
						<?php if(has_post_thumbnail()) : ?>
							<!-- Le post thumbnail -->
							<div class="row post-metas">
								<div class="col-md-9 center-block">
									<div class="post-thumbnail">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail("large", array("class"=>"img-responsive")); ?></a>
									</div>
									<div class="entry-meta">
										<span class="post-date <?php echo $couleur_theme; ?>"> <?php the_date('d/m/Y'); ?> </span>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<div class="row">
							<div class="col-md-9 center-block">
								<h2 class="entry-title lato" itemprop="headline"> 
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php
											$titre = get_the_title();
											$titre_final = preg_replace("/\([^)]+\)/","",$titre); 
											echo $titre_final;
										?>
									</a>
								</h2>
							</div>
						</div>
					</header>

					<!-- Contenu de l'article -->
					<div class="entry-content">
						<div class="row">
							<div class="col-md-9 center-block">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo excerpt(80); ?></a>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<!-- footer de l'article ( articles similaires ) -->
					<footer>
						<div class="row">
							<div class="col-md-4">
								<div class="thumb">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail("large",array("class"=>"img-responsive")); ?></a>
								</div>
							</div>
							<div class="col-md-8">
								<h3>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<?php
											$titre = get_the_title();
											$titre_final = preg_replace("/\([^)]+\)/","",$titre); 
											echo $titre_final;
										?>
									</a>
								</h3>
								<p><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo excerpt(40); ?></a></p>
							</div>
						</div>
					</footer>
				<?php } ?>
				<?php $n++; endwhile; ?>
			</article>
		</div>
		<!-- ici commence le sidebar -->
		<div id="sidebar" class="col-md-3">
			<?php get_sidebar(); ?>
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