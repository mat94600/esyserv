<?php
/*
Plugin Name: Simple Category Icons
Plugin URI: http://www.weblogmechanic.com/plugins/simple-category-icons
Description: A simple way to add icons to your categories and other taxonomies
Version: 1.12
Author: Bas Schuiling
Author URI: http://www.weblogmechanic.com/
License: GPL
*/


class simpleCategoryIcons 
{

	private $sizes = array();
	private $defaults = array(); // default sizes

function __construct() 
{
	$this->sizes = array(
					"small" => __("small"),
				   'medium' => __("medium"),
				   'large' => __("large")
				  ); 
	$this->defaults = array('small_w' => 20,
							'small_h' => 20, 
							'medium_w' => 40, 
							'medium_h' => 40, 
							'large_w' => 60, 
							'large_h' => 60);
				  
	add_action('admin_menu',array($this,'sci_settings_menu') ); 
	add_action('admin_init',array($this,'init') );
	
	// add actions ( allow for more than one taxonomy to be edited
	$taxSettings = $this->getTaxonomySettings();
	if ($taxSettings == "") $taxSettings = array();
	foreach($taxSettings as $tax => $active)
	{
		if ($active == 1)
		{
			add_action( $tax . "_add_form_fields", array($this,'sci_add_new_metafield'), 10, 2 );
			add_action( $tax . "_edit_form_fields", array($this,'sci_edit_metafield'), 10, 2 );
			add_action( "edited_" .$tax, array($this,'sci_save_metafield'), 10, 2 );  
			add_action( "create_" . $tax, array($this,'sci_save_metafield'), 10, 2 );
			add_filter( 'manage_edit-' .$tax. '_columns', array($this,'sci_category_column' )) ;
			add_filter( 'manage_' . $tax. '_custom_column', array($this,'sci_category_column_data'),10,3);
		}
	}


	// Ajax calls for image processing
	add_action( 'wp_ajax_sci_new_icon', array($this, 'sci_ajax_new_icon'));

	// custom image sizes for icons
	add_image_size('sci_icon_small',$this->getDimensions('small','w'),$this->getDimensions('small','h'),true);
	add_image_size('sci_icon_medium',$this->getDimensions('medium','w'),$this->getDimensions('medium','h'),true);
	add_image_size('sci_icon_large',$this->getDimensions('large','w'),$this->getDimensions('large','h'),true);
	
	// add short code 
	


}

public function init()
{

	// dirty hack to get around wp_enqueue_media bug ( http://core.trac.wordpress.org/ticket/22843 )
	global $pagenow;
	if ($pagenow != 'post.php' && $pagenow != 'post-new.php')
	{	wp_enqueue_media();

	}
    wp_register_script('sci-js', plugins_url('simple_category_icons.js', __FILE__), array('jquery'));
	wp_enqueue_script('jquery');
	wp_enqueue_script('sci-js');
	
	$nonce = wp_create_nonce(); 
	wp_localize_script( 'sci-js', 'ajax_object',
           		 array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'we_value' => $nonce,
           		 		'loader_url' => plugins_url('images/ajax-loader.gif',__FILE__ ) ) );    	
	
	wp_register_style('sci-css',plugins_url('simple_category_icons.css', __FILE__)); 
	wp_enqueue_style('sci-css');
}

public function sci_settings_menu()
{
	add_options_page(__("Simple Category Icons Settings") ,__("Simple Category Icons"),'manage_options',plugin_dir_path(__FILE__) . 'simple_category_icons_admin.php' ); 

}

public function sci_category_column($columns)
{
	$columns["icon"] = __("Icon");
	return $columns;
}	

public function sci_category_column_data($deprecated, $column, $post_id)
{	

	if ($column == 'icon')
	{	
		//$icons = get_post_meta($post_id,'sci_icons',true);
		$icons = get_option("scitax_" .$post_id); 

		if (! is_array($icons)) return;
		foreach($icons as $size => $attach_id) 
		{
			if($attach_id > 0) 
			{ $img = wp_get_attachment_image($attach_id,'sci_icon_small');
				return $img;
			}
		}
	}
}

public function sci_add_new_metafield() 
{
?>
	<label for="parent"><?php _e("Category Icons") ?></label>

	<?php foreach ($this->sizes as $size => $label) { ?> 

	<label for="upload_image"> <?php echo $label ?>
		<div id="sci_preview_<?php echo $size ?>"></div><div id='sci_remove'><a><?php _e("Remove Icon") ?></a></div>
    <input id="sci_icon_<?php echo $size ?>" type="hidden" size="36" name="sci_icon_<?php echo $size ?>" value="http://"  />
    <input id="<?php echo $size ?>" class="sci_icon_button button" type="button" value="Upload Image" />
    <br />
    	
	</label>
	<?php } ?>
<?php
}

public function sci_edit_metafield($term)
{
	$id = $term->term_id; 

	// Fix 1.11
	//$icons = get_post_meta($term->term_id,'sci_icons',true);
	$icons = get_option("scitax_" .$id); 

	$output = "</tbody></table>
				<h2>" . __("Category Icons") . "</h2> 
			  <table class='form-table sci-form-table'><tbody>
			  "; 
				
	foreach($this->sizes as $size => $label) 
	{
		if (isset($icons[$size]))
		{
			$attach_id = $icons[$size]; 
			$img = wp_get_attachment_image($attach_id,"sci_icon_" .$size);
		//	$img = image_downsize($attach_id,$size);
	
		} 
		else  
		{
			$attach_id = 0; 
			$img = '';
		} 
		  		  
	$output .= '<tr class="form-field">
			<th scope="row" valign="top"><label>' . $label . '</label></th>';
	
	$output .= ""; 
		
	$output .= '<td>
				 <div id="sci_preview_' . $size . '" class="sci_icon_preview" >' . $img .'</div>
				 </td>
				
	 <td>
	  <input id="sci_icon_' . $size . '" type="hidden" name="sci_icon_' . $size .'" value="' . $attach_id . '" />
      <input id="' . $size . '" class="button sci_icon_button" type="button" value="Upload Image" />
		
				</td>
				<td><div><a class="sci_remove" id=' . $size . '>' . __("Remove Icon") . '</a></div></td>
				
				</tr>' ;
	}

	$output .= "</tbody>";
	echo $output; 
}

public function sci_save_metafield($term_id)
{
	$icons = array(); 
	
	foreach($this->sizes as $size => $label)
	{
		if (isset($_POST["sci_icon_" . $size]))
		{
			$attach_id = $_POST["sci_icon_$size"];
		
			if ($attach_id > 0)
			{
				$local_file = get_attached_file($attach_id);
		
				$attach_data = wp_generate_attachment_metadata($attach_id, $local_file);
				wp_update_attachment_metadata( $attach_id,  $attach_data );	
				$icons[$size] = $attach_id;
			}
		}
	}

	// then save the taxonomy metadata
	// FIX 1.11 Use Get_option for custom tax
	update_option("scitax_" . $term_id,$icons);
	
	//update_post_meta($term_id,'sci_icons',$icons);

}

public function getSizes()
{
	return $this->sizes; 
}

// dim = w / h
public function getDimensions($size,$dim = 'w') 
{
	if ($dim != ('w' || 'h')) return -1; 
	
	$val = get_option('sci_icon_' . $size . '_' .$dim);
	if (! $val || ! is_numeric($val))
	{
		return $this->defaults[$size . '_' . $dim];
	}
	else return $val;

}

public function saveDimensions($size,$dim = 'w', $value) 
{
	if ($dim != ('w' || 'h')) return -1; 
	if (! is_numeric($value)) return -2;
	
	update_option('sci_icon_'. $size . '_' . $dim, $value);
	return true;

}

public function getTaxonomySettings()
{
	$taxonomies =  get_option('sci_taxonomies'); 
	if ($taxonomies == "") // default to everything if there are no settings
	{ 
		$taxonomies = get_taxonomies(array(
						'public' => true,
						'show_ui' => true,

					), 'objects');
			$taxArray = array();
		foreach($taxonomies as $taxonomy => $taxObj)
		{
			$taxArray[$taxonomy] = 1;
		
		}			
		return $taxArray;
	
	
	}
	return $taxonomies;
}

public function saveTaxonomySettings($taxSettings)
{
	$r = update_option('sci_taxonomies',$taxSettings);
	return $r;
}

public function taxonomyIsActive($tax_type)
{
	$taxonomies = $this->getTaxonomySettings();
	if (array_key_exists ($tax_type, $taxonomies))
	{

		if ($taxonomies[$tax_type] == 1)
			return true; 
		else 
			return false;
	}
	else
		return false;

}

/*** Ajax Functions */
public function sci_ajax_new_icon()
{
	//retrieve image
	if (! isset($_POST["img_url"]))
		die ("Error: No URL");
	
	$attach_id = $_POST["attach_id"];
	$size = $_POST["size"]; // which size are we doing? 
				
   $local_file = get_attached_file($attach_id);
   
	// generate metadata on basis of sizes
	$attach_data = wp_generate_attachment_metadata($attach_id, $local_file);
	wp_update_attachment_metadata( $attach_id,  $attach_data );	

	// return new image URL
	$data = array("newimg" => image_downsize($attach_id, "sci_icon_" . $size),
				  "size" => $size	
				);
	
	header('Content-Type: application/json');
	echo json_encode($data);
	exit();

}


} // end class


// template tags
// @Todo reverse code. Make the_icon get code from get_the_icon and display
 function the_icon($args, $term_type = 'category',$id = null, $use_term_id = null) 
{

	$default = array(
		'class' => ''
		
	); 		
	$args = wp_parse_args($args,$default);
	extract($args);

	
	$args["returnFull"] = true; 
	$arr = get_the_icon($args, $term_type, $id, $use_term_id);
	

	if (! is_array($arr))
		return false;
	
	$cat = $arr[0];
	$icondata = $arr[1];
	$icon = $icondata[0];
	$width = $icondata[1];
	$height = $icondata[2];
	
	$id = $cat->term_id;
	$title = $cat->name;
	$title = apply_filters('sci_icon_title',$title, $id);

	if (trim($class) != "") $dispClass = "class='$class'"; 
	else $dispClass = ""; 
 
 	$output = " <img src='$icon' title='$title' alt='$title' $dispClass id='sci_icon_$id' width='$width' height='$height' /> ";
 	$output = apply_filters('sci_print_icon',$output,$id);
	echo $output; 
} 

// get data for further going
// include args for returning only url ( default ) or full term object
 function get_the_icon($args, $term_type = 'category',$id = null, $use_term_id = null)
{
	global $sci;
	if (! $sci->taxonomyIsActive($term_type))
	{

		return false;
	}

	$default = array(
				'size' => 'medium',
				'returnFull' => false,
				
			);

	$args = wp_parse_args($args,$default);
	extract($args);

	
	if (is_null($id)) 
		$id = get_the_ID();

	if (! is_null($use_term_id)) 
	{	
		$term = get_term($use_term_id, $term_type);
		$term_id = $term->term_id;
	}
	else
	{
		$terms = get_the_terms($id, $term_type);

		if (! is_array($terms))
			return false;

		$term = findLowestCategory($terms);	
		if ($term == "") return false; // if return fails 

		$term_id = $term->term_id; 
	}
	//$icons = get_post_meta($term_id,'sci_icons',true);
	$icons = get_option("scitax_" .$term_id); 
	

	if (isset($icons[$size]))
	{
		$attach_id = $icons[$size];
		$url = wp_get_attachment_image_src($attach_id,"sci_icon_".$size);
		if ($returnFull)
			return array($term, $url);
		else
			return $url[0];
		
	}
	else return false;

}

// utility for template functions 
// @todo better solution
 function findLowestCategory($categories)
{
	foreach($categories as $category) :
		$children = get_categories( array ('parent' => $category->term_id ));
		$has_children = count($children);
		if ( $has_children == 0 ) {
			$category = apply_filters('sci_category_decision',$category, $categories);
	 		return $category;
		}
	endforeach;
}



$sci = new simpleCategoryIcons(); // go

?>
