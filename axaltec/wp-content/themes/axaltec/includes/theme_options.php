<?php
// Add our CSS Styling
wp_enqueue_style( 'theme-options', get_template_directory_uri() . '/includes/theme-options.css' );

add_action( 'admin_init', 'myThemeRegisterSettings' );

function myThemeRegisterSettings( )
{
	register_setting( 'exaltec_champs', 'google_maps' ); // couleur de fond
	register_setting( 'exaltec_champs', 'linkedin' ); 
	register_setting( 'exaltec_champs', 'viadeo' ); 
	register_setting( 'exaltec_champs', 'adresse_axaltec' ); 
	register_setting( 'exaltec_champs', 'text_color' );
}

add_action( 'admin_menu', 'myThemeAdminMenu' );

function myThemeAdminMenu( )
{
	add_menu_page(
		'Options du theme axaltec', // le titre de la page
		'Theme Axaltec',            // le nom de la page dans le menu d'admin
		'administrator',        // le rôle d'utilisateur requis pour voir cette page
		'axaltec_theme_page',        // un identifiant unique de la page
		'exaltec_theme_option'   // le nom d'une fonction qui affichera la page
		);
}

function exaltec_theme_option( )
{ ?>
	<div class="wrap">
		<h2>Options du theme Axaltec</h2>

		<form method="post" action="options.php">
			<?php

				settings_fields( 'exaltec_champs' );
			?>

			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="google_maps">Adresse google map</label></th>
					<td>
						<input type="text" id="google_maps" name="google_maps"  value="<?php echo get_option( 'google_maps' ); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="linkedin">Linkedin</label></th>
					<td>
						<input type="text" id="linkedin" name="linkedin"  value="<?php echo get_option( 'linkedin' ); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="viadeo">Viadeo</label></th>
					<td>
						<input type="text" id="viadeo" name="viadeo"  value="<?php echo get_option( 'viadeo' ); ?>" />
					</td>
				</tr>
				<!-- Adresse Axaltec -->
				<tr valign="top">
					<th scope="row"><label for="adresse_axaltec">Adresse Axaltec</label></th>
					<td>
						<?php 
							$content = get_option( 'adresse_axaltec' );
							$editor_id = 'adresse_axaltec';
							$settings = array( 'editor_class'=>'axaltec_textarea','textarea_name' => 'adresse_axaltec','media_buttons' => false, 'textarea_rows'=>5);
							wp_editor( $content, $editor_id, $settings );
						?>
						
					</td>
				</tr>
				
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="Mettre à jour" />
			</p>
		</form>
	</div>
	<?php }