<section class="nos-refs">
	<h3> Nos références </h3>
	<?php 

		/* === Les références 
		(post_type => références) 
		@ nos_refs() (functions.php)
		*/
		$args = array(
			'post_type'=>'references',
			'posts_per_page' => 12
		);

		$query = new Wp_Query($args);
	?>

	<?php $n=0; while($query->have_posts()):$query->the_post(); ?>

		<div class="col-md-2 col-xs-4 col-sm-2 <?php if($n==11) echo 'b_bleu' ?>">
			<?php
				if($n!=11):
					if(has_post_thumbnail()):
						the_post_thumbnail("large",array("class"=>"img-responsive"));
					else:
						the_post_thumbnail("large",array("class"=>"img-responsive"));
					endif;
				else:
					echo "<a class='three-d' href='".get_bloginfo('url')."/references' title='Toutes nos références'>";
						echo "<span class='three-d-box'>";
							echo "<span class='front'> > </span>";
							echo "<span class='back'> > </span>";
						echo "</span>";
					echo "</a>";
				endif;
			?>
		</div>

	<?php $n++; endwhile;?>

</section>