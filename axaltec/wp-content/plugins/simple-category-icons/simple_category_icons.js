var jq = jQuery.noConflict();
jQuery(document).ready(function () {


  var custom_uploader;

 	
 	jq(".sci_remove").click( function(e) { sci_remove_image(e) });
 	
 	jq(".sci_icon_button").click(function(e) { sci_image_uploader(e) });
 	
 	function sci_image_uploader(e)
 	{
        e.preventDefault();
	 	size = e.target.id;

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
 		title = 'Choose Image';
 		var term_name = jq('input[name="name"]').attr('value');
 		if (term_name != 'undefined' && term_name != '')
 			title = title + ' for ' + term_name;
 			
 		title = title + ' (' + size + ')';	 
 			
 		
 		console.log(term_name);
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: title,
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();


            var attach_id = attachment.id; 
            var data = {
			action:  'sci_new_icon',
			img_url: attachment.url,
			attach_id: attach_id, 
			size: size
			};
            
            jq.post(ajax_object.ajax_url, data, function(response) {

	            jq('#sci_icon_' + size).val(attach_id);
	            jq('#sci_preview_' + size).html('<img src=' + response.newimg[0] + '>');
            
            }); 
            
            
        });
 
        //Open the uploader dialog
        custom_uploader.open();
    }
 
	function sci_remove_image(e)
	{
		size = e.target.id;
		jq('#sci_icon_' + size).val(-1);
		jq('#sci_preview_' + size).html('');   
	}
});
