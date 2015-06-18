var layers = {};
var layers_vis = {};
var glayers_index = [];

     function main(url,layers_index,map_center,zoom) {
		glayers_index = layers_index;
		
		map_center = map_center.split("??")
		var center = [];
		center.push(map_center[0]);
		center.push(map_center[1]);
		//alert(map_center)
		cartodb.createVis('map', url, {
            tiles_loader: true,
			no_cdn: true,
            center: center,
			zoom: zoom
           
        })
        .done(function(vis, lyrs) {
          
         // var map = vis.getNativeMap();
          // now, perform any operations you need
           //map.setZoom(3);
           //map.panTo([50.5, 30.5]);
		
		
		 for (var i = 0; i < lyrs[1].layers.length; i++) { 
				 lyrs[1].getSubLayer(i).hide()
				 
					 
				if(vis.legends != undefined)
				  {
					  if(vis.legends.getLegendByIndex(i) != undefined)
					 	vis.legends.getLegendByIndex(i).hide();
				  }	 
					 
			}
		 
		 jQuery.each(glayers_index,function( index, value ) {
			  //console.log( index + ": " + value );
			  if(value)
			   {
				 var dvar = "li_"+value;
			  	 //console.log(dvar)
			  	 layers[dvar] = lyrs[1].getSubLayer(value);
				 //console.log(vis)
			  	 if(vis.legends != undefined)
				  {
					  if(vis.legends.getLegendByIndex(value) != undefined)
					  	layers_vis[dvar] = vis.legends.getLegendByIndex(value);   
				  }
				 	//layers_vis[dvar] = vis.legends.getLegendByIndex(value);   
			   }
			  
			});
		 
		
		
		  jQuery.each(glayers_index,function( index, value ) {
			  
			  if(value)
			   {
				 var dvar = "li_"+value;
			  	 //console.log(dvar)
			  	 layers[dvar].hide()
			   if(vis.legends != undefined)
				  {	
					if(vis.legends.getLegendByIndex(value) != undefined)
					 layers_vis[dvar].hide();
				  }
			   }
			});
			
			layers["li_0"].show()
			 if(vis.legends != undefined)
				  {
					if(vis.legends.getLegendByIndex(0) != undefined)
						layers_vis["li_0"].show();
				  }
		  jQuery(".cartodb-searchbox").hide();
		  jQuery(".cartodb-share").hide();
		  jQuery(".cartodb-zoom").hide();
		
        })
        .error(function(err) {
          console.log(err);
        });
      }
	  
	function getType(id,cid)
	 {
		var path = jQuery('#path').val()+"ajax/carto.php";
		var param = "id="+id+"&cid="+cid;
		
		
		jQuery.ajax({
			type: 	'POST',
			data: 	param,
			url:	path,
			success:function(msg){
					
					if(msg)
					 {
						msg = msg.split("?||?");
						if(msg[0] && msg[1])
						 {
							if(id == 2)
								window.location.href = "country1.php?cid="+msg[1]+"&type="+msg[0];	
							else
							 	window.location.href = "country.php?cid="+msg[1]+"&type="+msg[0];	
						 }
						else
						 {
						 	alert("Error while loading url!!!"); 
						 }
					 }
					else
					 {
						
						alert("Error while loading url!!!");
					 }
					
					
				}
		
			//window.location.href = "test.php?cid";
	 	});
	 }
	  
	  $(document).ready(function() {
		
		
	jQuery("a[rel*='mybox']").mybox();		
	jQuery("a[rel*='mybox']").click(function(){
										
						})
		
		jQuery("#for").click(function(){
			var path = jQuery('#path').val()+"ajax/login.php";
			var username = jQuery("#username").val();
			var pass = jQuery("#pass").val();
			var param = "username="+username+"&pass="+pass;
			
			
			jQuery.ajax({
				type: 	'POST',
				data: 	param,
				url:	path,
				success:function(msg){
						
						if(msg)
						 {
							location.reload();
						 }
						else
						 {
							jQuery('#error_').html("Username/Password Is Incorrect");
							//alert("Error while ogin!!!");
						 }
						
						
					}
			
				//window.location.href = "test.php?cid";
			});
			
			})
		
		
		
		jQuery( "input[id*='li_']" ).click(function(){
			
			var indicator = "";
			indicator = $(this).parents().get(0).rel;
			if(this.type == "checkbox"  )
			 {
			 
				 if(jQuery("#"+this.id).is(':checked'))
				 {
					 var layer_id_arr = (this.id).split("_");
					 if(layer_id_arr[1])
					 {
							
				
						layers["li_"+layer_id_arr[1]].show()
						if(layers_vis["li_"+layer_id_arr[1]] != undefined)
							layers_vis["li_"+layer_id_arr[1]].show();		
								
					 }
			 	}
				else
				 {
					 var layer_id_arr = (this.id).split("_");
					 if(layer_id_arr[1])
					 {
							
				
						layers["li_"+layer_id_arr[1]].hide()
						if(layers_vis["li_"+layer_id_arr[1]] != undefined)
							layers_vis["li_"+layer_id_arr[1]].hide();		
								
					 }
				 }
			 }
			else if(this.type == "radio")
			 {
				
				 var layer_id_arr = (this.value).split("_");
				 if(layer_id_arr[1])
				 {
						jQuery.each(glayers_index,function( index, value ) {
						  if(value)
						   {
							 var dvar = "li_"+value;
							 if(jQuery("#"+dvar).attr('type') !="checkbox")
							  layers[dvar].hide()
							 
								 if(layers_vis[dvar] != undefined && jQuery("#"+dvar).attr('type') !="checkbox")
									layers_vis[dvar].hide();
							  
						   }
							});		 
			
					layers["li_"+layer_id_arr[1]].show()
					if(layers_vis["li_"+layer_id_arr[1]] != undefined)
						layers_vis["li_"+layer_id_arr[1]].show();		
							
				 }
			 }
			
			
			
			
			})	
		  }) 
	  