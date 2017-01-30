(function($){
//upload image
    var total_sp_array={};
    $(document).ready(function(){
        $('.sp-open-select-frame').on( 'click' , function(){
            //accepts an optional object hash to override default values
            var frame = new wp.media.view.MediaFrame.Select({
                //modal title
                title: 'Select SP Logo',
                
                //enable/disable multiple select
                multiple: false,
                
                //library wordpress query arguments
                library: {
                        order: 'ASC', 
                    
                        //['name','author','date','title','modified','uploadedTo','id','post__in','menuOrder']
                        orderby: 'title',
                        
                        //mime type e.g. 'image','image/jpeg'
                        type: 'image',
                    
                        //searches the attachment title
                        search: null,
                    
                        //attached to a specific post (ID)
                        uploadedTo: null
                },
                
                button:{
                        text: 'Upload strategy partner logo'
                }
            });
            
            // Fires after the frame markup has been built, but not appended to the DOM.
			// @see wp.media.view.Modal.attach()
			frame.on( 'ready', function() {} );

			// Fires when the frame's $el is appended to its DOM container.
			// @see media.view.Modal.attach()
			frame.on( 'attach', function() {} );

			// Fires when the modal opens (becomes visible).
			// @see media.view.Modal.open()
			frame.on( 'open', function() {} );

			// Fires when the modal closes via the escape key.
			// @see media.view.Modal.close()
			frame.on( 'escape', function() {} );

			// Fires when the modal closes.
			// @see media.view.Modal.close()
			frame.on( 'close', function() {} );

			// Fires when a user has selected attachment(s) and clicked the select button.
			// @see media.view.MediaFrame.Post.mainInsertToolbar()
			frame.on( 'select', function() {
				var selectionCollection = frame.state().get('selection').first().toJSON();
                //url = selectionCollection.url
                var object = {};
                //selectionCollection.url selected image url       
               // object.url = selectionCollection.url;
                //object.website = selectionCollection.description;
                //object.companyname = selectionCollection.caption;
                //total_members_array.push(object);
                total_sp_array.url = selectionCollection.url;;
                total_sp_array.website = selectionCollection.description;
                total_sp_array.companyname = selectionCollection.caption;
                console.log(total_sp_array);
                
                //>>debug info
                //console.log("new member photo url is : "+total_members_array);
                //pass ajax to wp_ajax handling file url = ajaxurl
                //console.log("ajax url is : "+ajaxurl);
                //<<debug info
                
                if (total_sp_array){
                    //have new added image(s)
                    //wordpress require data.action not empty otherwise return 0
                    //console.log("security nonce is "+add_nonce.security_nonce);
                    $.ajax({
                        type: "POST",
                        data: { 
                            action: 'sp_ajax_callback',
                            sp_post_array_url: total_sp_array.url,
                            sp_post_array_website: total_sp_array.website,
                            sp_post_array_companyname: total_sp_array.companyname,
                            sptoadditem_nonce: sp_add_nonce.sp_additem_nonce
                        },
                        url: ajaxurl,
                        success: function(result){
                            //console.log("send total members update info to POST");
                            //console.log("php got ajax and send back "+result);
                            //location.reload();
                            //>>>real ajax
                            var resultToArray = $.parseJSON(result);
                            console.log("json to array "+resultToArray.url);
                            var $companyname = resultToArray.companyname?resultToArray.companyname:"";
                            var $url = resultToArray.url?resultToArray.url:"";
                            var $website = resultToArray.website?resultToArray.website:"";
                            
                            var $items =  $('#sp_grid_show_container');
                            var $itemIndex = $('.sp_grid_show_item_container').length+1;
                            $items.find('.clear').remove();
                             $items.append('<div class="sp_grid_show_item_container"><a href="'+$website+'" target="_blank"><img src="'+$url+'"class="sp_grid_show_item" data-index="'+$itemIndex+'"/></a><div class="sp_grid_show_item_buttons hide"> <button class="change_grid_show_item left">Change Title</button><button class="delete_current_grid_show_item left">delete</button></div><div class="sp_grid_show_item_companyname">'+$companyname+'</div></div>');
                            $items.append('<div class="clear"></div>');
                            
                           
                        
                        },
                        error: function (ErrorResponse) {
                            if (ErrorResponse.statusText == "OK") {
                                console.log("OK:send total members update info to POST");
                            }
                            else {
                               console.log("ErrorMsg:" + ErrorResponse.statusText);
                            }
                         }
                    });
                }
                else{
                    //dont have new image
                    
                }
                
                
			} );

			// Fires when a state activates.
			frame.on( 'activate', function() {} );

			// Fires when a mode is deactivated on a region.
			frame.on( '{region}:deactivate', function() {} );
			// and a more specific event including the mode.
			frame.on( '{region}:deactivate:{mode}', function() {} );

			// Fires when a region is ready for its view to be created.
			frame.on( '{region}:create', function() {} );
			// and a more specific event including the mode.
			frame.on( '{region}:create:{mode}', function() {} );

			// Fires when a region is ready for its view to be rendered.
			frame.on( '{region}:render', function() {} );
			// and a more specific event including the mode.
			frame.on( '{region}:render:{mode}', function() {} );

			// Fires when a new mode is activated (after it has been rendered) on a region.
			frame.on( '{region}:activate', function() {} );
			// and a more specific event including the mode.
			frame.on( '{region}:activate:{mode}', function() {} );

			// Get an object representing the current state.
			frame.state();

			// Get an object representing the previous state.
			frame.lastState();

			// Open the modal.
			frame.open();
            
            //console.log('inside click function');
            
        });

    });
    
    
    
})(jQuery);