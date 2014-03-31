<div class="sliderBtn row">
	<div class="col-md-9 center-block hidden-sm">
		<div  id="fBtn" data-increment="0" class='col-md-4 actif' data-class="reseau-structure"> <span> Un réseau structuré</span> </div>
		<div  id="sBtn" data-increment="1" class='col-md-4 ' data-class="experts-reconnus" > <span> Des experts réconnus </span> </div>
		<div  id="lBtn" data-increment="2" class='col-md-4 last ' data-class="defis-stimulants"> <span> Des défis stimulants </span> </div>
		<p id="slider-position" style="display:block"></p>
	</div>
	
</div>

<div class="row sliderC">
	<div class="solutions col-md-6 col-sm-6"> <!-- col-md-4 before -->
		<div class="clearfix">
			<div class="b_erp_sap">
				<a href="#">
					<img src="<?php bloginfo('template_url'); ?>/assets/images/icones/solutions/erpsap.png" class="img-responsive item--solutions">
				</a>
			</div>
			<div class="b_erp_jde">
				<a href="<?php bloginfo('url'); ?>/solutions/erp-jde" title="<?php bloginfo('name'); ?>">
					<img src="<?php bloginfo('template_url'); ?>/assets/images/icones/solutions/erpjde.png" class="img-responsive"></div>
				</a>
		</div>
		<div class="clearfix">
			<div class="b_erp_aps">
				<a href="<?php bloginfo('url'); ?>/solutions/aps" title="<?php bloginfo('name'); ?>">
					<img src="<?php bloginfo('template_url'); ?>/assets/images/icones/solutions/aps.png" class="img-responsive">
				</a>
			</div>
			<div class="b_erp_crm">
				<a href="<?php bloginfo('url'); ?>/solutions/crm" title="<?php bloginfo('name'); ?>">
					<img src="<?php bloginfo('template_url'); ?>/assets/images/icones/solutions/crm.png" class="img-responsive">
				</a>
			</div>
		</div>
	</div>
	<div id="banner-fade" class="slider col-md-5 hidden-xs hidden-sm">
		<ul class="bjqs">
			<?php 
				$args = array(
					'post_type'=>'slideshow'
				);
				$query = new Wp_Query($args);
				while($query->have_posts()):$query->the_post();
			?>
			<li class="reseau-structure">
				<div class="desc" style="position:absolute;">
					<h3><?php the_title(); ?></h3>
					<p><?php the_content(); ?></p>
				</div>
				<?php 
					if(has_post_thumbnail()){
						the_post_thumbnail("large", array("class"=>"img-responsive img-responsive"));
					}
				?>
			</li>
			<?php endwhile; wp_reset_postdata(); ?>
		</ul>
	</div>
	<div class="offres col-md-3 col-sm-6">
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
			<a href="<?php bloginfo('url');?>/offres/<?php echo $pages_enfants->post_name; ?>" title="Assistance Maitrise d'ouvrage">
				<span class="off">
					<?php  echo $grand_titre[0]; ?>
				</span>
				<span>
					
					<?php  echo $sous_titre; ?>
				</span>
			</a>
		<?php
			}
		?>
	</div>
</div> 