<?php
	/*
	======================
	Récuperer les pages enfants 
	de solutions pour extraire les champs temoignages
	les_pages_enfants() -> functions.php
	======================
	*/
	global $post;
	$results = les_pages_enfants(132,10);
	foreach($results as $result){
		$ID_page = $result->ID;
		$temoignages = get_post_meta($ID_page, 'wpcf-temoignages', true);
	}
	
?>
<div class="slideTemoignages relatif">
	<h3 class="o_sans c_bleu relatif"> Temoignages </h3>
	<div id="control">
		<a href="#" id="Prev" class="Prev b_bleu"> < </a>
		<a href="#" id="Next" class="Next b_bleu"> > </a>
	</div>
	<div class="col-md-11 center-block">
		<div class="overflowTemoignages relatif">	
			<?php 
				foreach($results as $result){
				$ID_page = $result->ID;
			?>
				<div class="col-md-6 col-xs-6"><?php echo $temoignages; ?></div>
			<?php } ?>
		</div>
	</div>
</div>