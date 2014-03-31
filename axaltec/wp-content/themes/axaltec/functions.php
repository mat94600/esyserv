<?php
include"includes/theme_options.php";
/*
================= MENU WORDPRESS
*/
register_nav_menus( array(
    'Top' => 'Navigation principale',
    'Bottom' => 'Bas de page'
) );

/*
================= Ajouter le thumbnail 
*/
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

/* ================= SHORTCODES */
add_shortcode("acroche_bleue", "acroche_bleue");
add_shortcode("contact_adresse", "contacts");
add_shortcode("resp_business_unit", "resp_business");
/* accroche */
function acroche_bleue( $atts, $content = null ) {
    return '<span class="simple_rarr c_bleu">'.$content.'</span>';
}


/* contact */
function contacts($atts, $content = null){
  $contact  = '<div class="row">';
  $contact .= '<div class="col-md-12">';
  $contact .= '<h3 class="o_sans c_bleu relatif"> Nous trouver </h3>';
  $contact .= '<div class="col-md-11 center-block floatNone">';
  $contact .= '<div class="col-md-6">';
  $contact .= $content;
  $contact .='</div>';
  $contact .='</div>';
  $contact .='</div>';
  $contact .='</div>';

  return $contact;
}

/* Responsable Business Unit*/
function resp_business($atts, $content=null){

  $resp_business  .= '<div class="col-md-4">';
  $resp_business  .=  $content;
  $resp_business  .= '</div>';

}

/*
=============== Limiter l'excerpt
*/
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}



/* Recuperer les pages  */
add_action( 'body_class', 'theme_solutions');

function theme_solutions($classes){

  if(is_page('APS')){
      $classes[] = 'theme_aps';
      return $classes;
  }elseif(is_page('CRM')){
      $classes[] = 'theme_crm';
      return $classes;
  }elseif(is_page('ERP-JDE')){
      $classes[] = 'theme_erp_jde';
      return $classes;
  }elseif(is_page('ERP-SAP')){
      $classes[] = 'theme_erp_sap';
      return $classes;
  }else{
      $classes[] = 'theme_default';
      return $classes;
  }

}

/* Recuperer la categorie */

function lacategorie(){
  global $post;
  $categorie = get_the_category($post->ID);
  return $categorie;
}

function cagetorie_parent(){

  $categorie = lacategorie();

  foreach ($categorie as $cat_parent) {
      $categ_parent = $cat_parent->term_id;

      switch ($categ_parent) {
        case '6':
          $theme   = 'theme_erp_jde';
          break;
        case '7':
          $theme   = 'theme_aps';
          break;
        case '8':
          $theme   = 'theme_erp_sap';
          break;
        case '9':
          $theme   = 'theme_crm';
          break;
        default:
          $theme = 'theme_default';
          break;
      }

      return $theme;
  }

}

function show_offres(){

  foreach((get_the_category()) as $childcat) {

    if (cat_is_ancestor_of(11, $childcat)) {

      $service =  "offres";

    }elseif (cat_is_ancestor_of(10, $childcat)){

      $service = "solutions";

    }

    return $service;
  }

}

function switch_offres(){
  global $post;
  $post_parent = $post->post_parent;
  return $post_parent;
}
/*
============================
  RECUPERER LES PAGES ENFANTS
============================
*/

function les_pages_enfants($pageId,$limit)
{
    // needed to use $post
    global $post;
    // used to store the result
    $pages = array();

    // What to select
    $args = array(
        'post_type' => 'page',
        'post_parent' => $pageId,
        'post__not_in' => array($post->ID),
        'posts_per_page' => $limit
    );
    $the_query = new WP_Query( $args );

    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $pages[] = $post;
    }
    wp_reset_postdata();
    return $pages;
}

/*
========= LE POST TYPE REFERENCES 
*/
add_action( 'init', 'nos_refs' );
function nos_refs() {
  register_post_type( 'References',
    array(
      'labels' => array(
        'name' => __( 'Références' ),
        'singular_name' => __( 'Reference' )
      ),
      'menu_icon' => 'dashicons-images-alt2',
      'public' => true,
      'public' => true,
      'show_ui' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'supports' => array('title', 'thumbnail')
    )
  );
}

/*
========= LE POST TYPE PARTENAIRES 
*/
add_action( 'init', 'partenaires' );
function partenaires() {
  register_post_type( 'Partenaires',
    array(
      'labels' => array(
        'name' => __( 'Partenaires' ),
        'singular_name' => __( 'Partenaire' )
      ),
      'menu_icon' => 'dashicons-businessman',
      'public' => true,
      'public' => true,
      'show_ui' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'supports' => array('title', 'thumbnail', 'editor')
    )
  );
}

/*
========= LE POST TYPE SLIDESHOW DANS LA HOME 
*/
add_action( 'init', 'home_slide' );
function home_slide() {
  register_post_type( 'slideshow',
    array(
      'labels' => array(
        'name' => __( 'Slideshows' ),
        'singular_name' => __( 'Slideshow' )
      ),
      'menu_icon' => 'dashicons-align-center',
      'public' => true,
      'public' => true,
      'show_ui' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'supports' => array('title', 'thumbnail', 'editor')
    )
  );
}

function gpp_jpeg_quality_callback($arg)
{
return (int)100;
}

add_filter('jpeg_quality', 'gpp_jpeg_quality_callback');