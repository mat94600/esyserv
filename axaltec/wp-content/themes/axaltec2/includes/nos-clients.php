<footer class="nos-refs nos-clients">
	<?php if(!is_page("references")): ?>
		<h3 class="o_sans c_bleu relatif"> Nos clients </h3>
	<?php endif; ?>
	<?php 

		/* === Les références 
		(post_type => références) 
		@ nos_refs() (functions.php)
		*/
		$args = array(
			'post_type'=>'references',
			'posts_per_page' => 100
		);

		$query = new Wp_Query($args);
	?>
	<?php while($query->have_posts()):$query->the_post(); ?>

		<div class="col-md-3 col-xs-6 col-sm-3">
			<?php 
				if(has_post_thumbnail()):
					the_post_thumbnail("large",array("class"=>"img-responsive"));
				else:
					the_post_thumbnail("large",array("class"=>"img-responsive"));
				endif;
			?>
		</div>

	<?php endwhile;?>		
</footer>
<?php get_template_part("includes/slideTemoignages"); ?>