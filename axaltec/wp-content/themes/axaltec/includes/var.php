<?php
	/* Nous joindre */
	$telephone	 	= get_post_meta($post->ID, 'wpcf-tel', true);
	$date 		 	= get_post_meta($post->ID, 'wpcf-date', true);
	$horaire 		= get_post_meta($post->ID, 'wpcf-horaire', true);

	/* Responsable */
	$nom		 	= get_post_meta($post->ID, 'wpcf-nom-du-responsable', true);
	$fonction 	 	= get_post_meta($post->ID, 'wpcf-fonction', true);
	$email 			= get_post_meta($post->ID, 'wpcf-e-mail', true);

	/* Temoignages */
	$temoignages    = get_post_meta($post->ID, 'wpcf-temoignages', true);
	$consultants    = get_post_meta($post->ID, 'wpcf-consultants', true);
?>