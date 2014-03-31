<div class="row ">
	<div class="col-md-3 col-sm-3 b_bleu">
		<span><a href="<?php bloginfo('url'); ?>/#" class="absolue"></a><?php _e('Nos<br>partenaires','ax'); ?></span>
		<a href="<?php bloginfo('url'); ?>/#" class="arrow three-d">
			<span class="three-d-box">
				<span class="front">&rarr;</span>
				<span class="back">&rarr;</span>
			</span>
		</a>
	</div>
	<!--div class="logo-parts logo-top-center absolue">
		<img src="<?php bloginfo("template_url"); ?>/assets/images/uploads/oracle_logo.jpg" class="img-responsive">
	</div>
	<div class="logo-parts logo-center absolue">
		<img src="<?php bloginfo("template_url"); ?>/assets/images/uploads/oracle_partner.png" class="img-responsive">
	</div>
	<div class="logo-parts logo-right-bottom absolue">
		<img src="<?php bloginfo("template_url"); ?>/assets/images/uploads/ortems.jpg" class="img-responsive">
	</div>
	<div class="logo-parts logo-top-right absolue">
		<img src="<?php bloginfo("template_url"); ?>/assets/images/uploads/mini-ortems.jpg" class="img-responsive">
	</div-->
	<!--div class="arrow-more-center absolue">
		<a href="#" class="arrow-more three-d">
			<span class="three-d-box">
				<span class="front">&rarr;</span>
				<span class="back">&rarr;</span>
			</span>
		</a>
	</div-->
	<?php 
		$args = array(
			'post_type'=>'Partenaires',
			'showposts'=>3
		);
	?>
	<div class="logos_partenaires col-md-9">
		<?php
			$query = new Wp_Query($args); 
			while ($query->have_posts()) : $query->the_post();
		?>
		
		<div class="col-md-4">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
			<div class="link">
				<a href="#" class="arrow three-d">
					<span class="three-d-box">
						<span class="front">&rarr;</span>
						<span class="back">&rarr;</span>
					</span>
				</a>
				<div class="titre"><?php the_title(); ?></div>
			</div>
		</div>
		<?php endwhile; ?>
	</div>
</div>