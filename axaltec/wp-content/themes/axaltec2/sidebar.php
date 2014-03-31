<?php
/* Récuperation des champs */
global $post;
$couleur_theme = cagetorie_parent();
include"includes/var.php";
?>

<?php 
if(is_single()):
	/*
		=================================================================
		RECUPERE LES ARTICLES SIMILAIRES
		DANS LA MEME CATEGORIE
		@ lacategorie() => array contenant la categorie du post en cours
		=================================================================
		*/
		foreach (lacategorie() as $cat) {
			$cat_ID  = $cat->cat_ID;
		}

		$args = array(
			'cat'=>$cat_ID,
			'post__not_in'=>array($post->ID),
			'showposts'=>5
			);

		query_posts($args);

		if(have_posts()):
			?>
		<!-- Widget titre sous rubrique -->
		<div class="widget b_bleu sous-rubriques">
			<div class="lato widget-content">
				<ul>
					<?php 
					while ( have_posts() ) : the_post(); 
					?>
					<li>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> 
							<?php
								$titre = get_the_title();
								$titre_final = preg_replace("/\([^)]+\)/","",$titre); 
								echo $titre_final;
							?>
						</a>
					</li>

				<?php endwhile; ?>
				<?php if(is_category('actualites')) ?>
					<li><a href="<?php bloginfo('url'); ?>/category/actualites" title="Axaltec : Toutes les actualités"> Toutes les actualités </a></li>
			</ul>
		</div>
	</div>

<?php endif; ?>
<?php endif; ?>

<?php if(is_page()) : ?>
	<?php 
		/*
		=======================================
		RECUPERER LES PAGES ENFANTS
		@ les_pages_enfants() - (functions.php)
		@ si des pages enfants existent 
		  on affiche, sinon on n'affiche pas
		======================================
		*/
		$post_parent = $post->post_parent;
		$result = les_pages_enfants($post_parent, 10);
	
		if(!empty($result)):
	?>
		<?php if(!is_page(12) || is_page(array(120,132))): ?>
			<div class="widget b_bleu sous-rubriques">
				<div class="lato widget-content">
					<ul>
					<?php

						foreach ($result as $pages_enfants) {
							
							if($pages_enfants->post_title !== 'Solutions' && $pages_enfants->post_title !== 'Offres' && $pages_enfants->post_title !== 'Partenaires'){
								$get_titre = $pages_enfants->post_title;
								$pages = preg_replace("/\([^)]+\)/","",$get_titre);
								echo "<li><a href='".get_permalink( $pages_enfants->ID )."'>".$pages."</a></li>";
							}
 							
					 	} 

					?>
					</ul>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<!-- 
	=======================
	BLOC NOUS JOINDRE
	=======================
	-->
	<?php if($telephone):?>
		<div class="widget b_bleu onglet">
			<h3 class="lato relatif">
				<i class="b_bleu"><img src="<?php bloginfo('template_url'); ?>/assets/images/icones/tel_28_31.png"></i>
				<span>Nous Joindre</span>
			</h3>
			<div class="lato widget-content">
				<div class="num"> <?php echo $telephone; ?></div>
				<div class="day"> <?php echo $date; ?> </div>
				<div class="hour"> <?php echo $horaire; ?> </div>
			</div>
		</div>
	<?php endif; ?>

	<!-- 
	=======================
	BLOC RESPONSABLE
	=======================
	-->
	<?php if($nom): ?>
		<!-- Widget responsable (changer la couleur b_bleu, b_gris etc... ) -->
		<div class="widget b_bleu onglet">
			<h3 class="lato relatif">
				<i class="b_bleu"><img src="<?php bloginfo('template_url'); ?>/assets/images/icones/mail_28_31.png"></i>
				<span>Responsable</span>
			</h3>
			<div class="lato widget-content">
				<div class="name"> <?php echo $nom; ?> </div>
				<div class="fn"> <?php echo $fonction; ?></div>
				<div class="mail"> <?php echo $email; ?></div>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>
<!-- 
	=======================
	ADRESSE
	=======================
-->
<?php if(!is_page(12)): ?>
	<!-- Widget contact (changer la couleur b_bleu, b_gris etc... ) -->
	<div class="widget adresse">
		<div class="widget-content">
			<?php 
				echo get_option('adresse_axaltec');
			?>
		</div>
	</div>
<?php endif; ?>
<!-- 
	=======================
	TEMOIGNAGES
	=======================
-->
<?php if($temoignages !="") : ?>
	<!-- Widget temoignages  -->
	<div class="widget temoignages">
		<h3 class="o_sans c_bleu relatif"> Temoignages </h3>
		<div class="widget-content">
			<?php echo $temoignages; ?>
		</div>
	</div>
<?php endif; ?>

<!-- 
	=======================
	CONSULTANTS
	=======================
-->
<?php if($consultants !="") : ?>
	<!-- Widget consultants  -->
	<div class="widget temoignages">
		<h3 class="o_sans c_bleu relatif"> Nos consultants </h3>
		<div class="widget-content">
			<?php echo $consultants; ?>
		</div>
	</div>
<?php endif; ?>

<!-- 
	=======================
	BLOC PROJET
	=======================
-->
<div class="widget b_gris projet">
	<div class="widget-content lato relatif">
		<p class="gm"> Vous avez <br />un projet ? </p>
		<p class="sm absolue"> Contactez-nous </p>
		<a href="<?php bloginfo('url');?>/contact" title="Contacter Axaltec" class="rarr absolue three-d">
			<span class="three-d-box">

				<span class="front">&rarr;</span>
				<span class="back">&rarr;</span>
			</span>
		</a>
	</div>
</div>

<!-- 
	=======================
	ABOUTON RECRUTEMENT
	=======================
-->
<div class="widget b_bleu recrutement">
	<div class="widget-content b_bleu lato">
		<a href="<?php bloginfo('url');?>/contact" title="Axaltec : recrutemenet" class="three-d">
			<span class="rarr b_gris">&rarr;</span> <span class="sm">Recrutement</span>
		</a>
	</div>
</div>