<!-- Les 4 boutons en bas -->
<section>

	<div class="offres univers row icons center-block ">
			<div class="col-md-3 col-xs-6 relatif">
				<a>
					<img class="img-responsive" src="<?php bloginfo("template_url"); ?>/assets/images/icones/offres/offres.png">
				</a>
			</div>
			<?php 

			// identifiant de la page "offres" parent de AMOA, TMA et AMOE
			$post_parent = "132"; 

			// Ici je recupere toutes les pages enfants de "offres", voir les_pages_enfants() dans functions.php
			$result = les_pages_enfants($post_parent, 10); 
			foreach($result as $pages_enfants){

				// recuperer le string avant l'ouverture de la parenthese dans le titre de la page
				$grand_titre = explode("(", $pages_enfants->post_title); 
				
				// recupérer ce qui sont entre "()"
				preg_match('#\(+(.*)\)+#', $pages_enfants->post_title, $result);
				
				// Supprimer les "()" pour les sous-titres
				$sous_titre = str_replace("(", "", $result[0]); 
				$sous_titre = str_replace(")", "", $sous_titre);

			
				
			?>
			<div class="col-md-3 col-xs-6 relatif">
				<a href="<?php bloginfo('url');?>/offres/amoa">
				
						<span class="grd">
							<?php  echo $grand_titre[0]; ?>
						</span>
						<span class="small">
							<?php  echo $sous_titre; ?>
						</span>

				</a>
			</div>
			<?php } ?>
	</div>
</section>