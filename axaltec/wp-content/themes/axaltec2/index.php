<?php get_header(); ?>
	<div class="container">
		<!-- section slider -->
		<section id="slidehome">
			<?php get_template_part("includes/slider","home");?>
		</section>

		<!-- Section bannieres -->
		<section>
			<div class="row">
				<!-- bannière ofa -->
				<div class="bann-ofa col-md-4  col-sm-4 col-lg-4 hidden-xs">
					<img src="<?php bloginfo('template_url'); ?>/assets/images/uploads/ofa.jpg" class="img-responsive">
				</div>

				<?php 
					$args = array(
						'post_type' => 'page',
    					'post__in' => array(4)
					);
				?>
				<?php 
				query_posts($args);
				while ( have_posts() ) : the_post(); ?>
					<!-- bloc presentation en 2 colonnes -->
					<div class="col-md-8 col-sm-8 .col-lg-8 presentation">
						<h3 class="upper"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
						<div class="row ">
							<div class="col-md-12 ">
								<p>
									<?php echo excerpt(50); ?>
								</p>
							</div>
							<div class="suite"> 
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="more-plus hidden-xs three-d"> 
									<span aria-hidden="true" class="three-d-box">
										<span class="front"> + </span>
										<span class="back"> + </span>
									</span>
								</a> 
							</div>
						</div>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
			<div class="row">

				<!-- bannière 2 -->
				<div class="col-md-4 col-sm-5 home-actu relatif">
					<?php
						$args = array(
							'category_name'=>'actualites',
							'showposts'=>1
						);
						$query = new Wp_Query($args);
						while($query->have_posts()):$query->the_post();
							if(has_post_thumbnail()){
								the_post_thumbnail('large',array("class"=>"img-responsive home-actu-img"));
							}
					?>

					
					<div class="more-news absolue lato">
						
							<span class="rarr">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="three-d">
									<span class="three-d-box">
										<span class="front">&rarr;</span>
										<span class="back">&rarr;</span>
									</span>
								</a>
							</span>
							<span class="titre-news"> <?php the_title(); ?>
								<span class="lieu-news">
									<?php 

										/*===========================================
										Recupérer ce qui est entre "()" dans le titre
										=============================================
										*/
										$titre = get_the_title();
										preg_match('#\(+(.*)\)+#', $titre, $resultat);
										echo $resultat[0];
									?>
								</span>
							</span>
						
						</div>
					</div>
				<?php endwhile; ?>
					<!-- partenaires -->
					<div class="col-md-8 col-sm-7 partenaires relatif hidden-xs">
						<?php 
							/* includes > partenaires.php */
							get_template_part("includes/partenaires"); 
						?>
					</div>
				</div>
		</section>
	
		<!-- Section references -->
		<?php 
			/* includes > refs-home.php */
			get_template_part("includes/refs","home"); 
		?>

	</div>
<?php get_footer(); ?>