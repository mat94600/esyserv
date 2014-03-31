<div class="wrap">
<?php screen_icon(); ?>
<h2><?php echo esc_html( $title ); ?></h2>


<?php
$sizes = $sci->getSizes();
$taxonomies = get_taxonomies(array(
						'public' => true,
						'show_ui' => true,

					), 'objects');

 if (isset($_POST) && isset($_POST["submit"])) 
 {

	foreach($sizes as $size => $label)
	{
	
		if (isset($_POST[$size . '_w']))
		{
			$sci->saveDimensions($size,'w',$_POST[$size . '_w']);
		}
		
		if (isset($_POST[$size . '_h']))
		{
			$sci->saveDimensions($size,'h',$_POST[$size . '_h']);
		}
	}	

		$taxSettings = array();
	foreach($taxonomies as $taxonomy => $taxObj)
	{
		
		if (isset($_POST['tax_' . $taxonomy]) && $_POST['tax_' . $taxonomy] == 1) 
			$taxSettings[$taxonomy] = 1; 
		else
			$taxSettings[$taxonomy] = 0; 
	
	}
	
	$sci->saveTaxonomySettings($taxSettings);
	
} 

	$taxSettings = $sci->getTaxonomySettings();
	//print_R($taxSettings);
?>

<form method="post" >

<?php submit_button(); ?>


<h3 class="title"><?php _e("Icon Sizes") ?></h3> 
<p><?php _e("Note that changing icon sizes doesn't effect already existing icons, nor will it cause to resize them") ?></p>
<table class="form-table sci_admin_table">


<?php 



foreach ($sizes as $size => $label) 
{
	$width = $sci->getDimensions($size,'w'); 
	$height = $sci->getDimensions($size,'h');
	
	
?>
<tr valign="top">
<th scope="row"><label for="blogname"><?php echo $label ?> </label></th> 
<td><input type="text" name="<?php echo $size ?>_w" value="<?php echo $width ?>" size="4"/> x
<input type="text" name="<?php echo $size ?>_h" value="<?php echo $height ?>" size="4" /> <?php _e("px"); ?></td>
</tr>


<?php
}

?>
 </table>

<h3 class="title"><?php _e("Taxonomies") ?></h3> 
<table class="form-table sci_admin_table">
<?php 


foreach($taxonomies as $taxonomy => $taxObj)
{
//	echo $taxonomy;
	$label = $taxObj->labels->name;
	//$taxonomy = $taxObj->
 	if (isset($taxSettings[$taxonomy]))
 	{
 		if ($taxSettings[$taxonomy] == 1)
	 		$sel = "CHECKED"; 			
	 	else 
	 		$sel = "";  
 	}
 	else
 		$sel = "CHECKED"; // default
?>


<tr valign="top">
<th scope="row"><label for="blogname"><?php echo $label ?> </label></th> 
<td><input type="checkbox" name="tax_<?php echo $taxonomy ?>" value="1" <?php echo $sel ?> >
</td>
</tr>
<?php } ?> 
</table>

<?php submit_button(); ?>

</form>


