// JavaScript Document
jQuery( document ).ready(function() {
 	jQuery("#cartodb_index").attr("disabled","disabled");
	jQuery("#layer_type").attr("disabled","disabled");  
	jQuery("#tr_parent").hide();
		jQuery("#tr_firstChild").hide();
		jQuery("#tr_SecondChild").hide();
	
	var level_e = jQuery("#level").val();
	
	if(level_e == 4 )
	 {
		jQuery("#cartodb_index").attr("disabled",false); 
		jQuery("#layer_type").attr("disabled",false); 
		jQuery("#tr_parent").show();
		jQuery("#tr_firstChild").show();
		jQuery("#tr_SecondChild").show();
 
	 }
	else if(level_e == 3)
	 {
		jQuery("#cartodb_index").attr("disabled",false);
		jQuery("#layer_type").attr("disabled",false); 
		jQuery("#tr_parent").show();
		jQuery("#tr_firstChild").show();
	 }
	else if(level_e == 2)
	 {
		jQuery("#cartodb_index").attr("disabled",false);
		jQuery("#layer_type").attr("disabled",false); 
		jQuery("#tr_parent").show();
		
	 }
	
});

function getVT(id)
{
	var err_txt = "";
	var err = "";
	var num = 0;
	jQuery(".txtin").css({border:bbclr});
	 
	
	 
   if(id)
	{	
	var path = jQuery('#path').val()+"ajax/layers.php";
	var param = "id="+id+"&act=getVT";
	
	
	jQuery.ajax({
		type: 	'GET',
		data: 	param,
		url:	path,
		success:function(msg){
				
				if(msg)
				 {
					jQuery("#td_VT").html(msg);				
				 }
				else
				 {
					 jQuery("#td_VT").html('Visualization type has been not defined!');
					jQuery("#msg1").html("Error while loading!!!");
				 }
				
				
			}
		})	 
	
	}
}

function getParent(id)
{
	var err_txt = "";
	var err = "";
	var num = 0;
	jQuery(".txtin").css({border:bbclr});
	jQuery("#tr_parent").hide();
	jQuery("#tr_firstChild").hide();
	jQuery("#tr_SecondChild").hide(); 
	var country = jQuery("#country").val();
	var visualization_type = jQuery("#visualization_type").val(); 
	 
	 
	if(id == 4)
	 {
		jQuery("#cartodb_index").attr("disabled",false); 
		jQuery("#layer_type").attr("disabled",false); 
	 }
	else
	 {
		if(id == 1)
		 {
		 	jQuery("#cartodb_index").attr("disabled","disabled"); 
			jQuery("#layer_type").attr("disabled","disabled");
		 }
		else
		 {
		 	jQuery("#cartodb_index").attr("disabled",false); 
		 	jQuery("#layer_type").attr("disabled",false); 
		 }
	 }
	var path = jQuery('#path').val()+"ajax/layers.php";
	var param = "id="+id+"&country="+country+"&visualization_type="+visualization_type+"&act=getParent";
	
	
	jQuery.ajax({
		type: 	'GET',
		data: 	param,
		url:	path,
		success:function(msg){
				
				if(msg)
				 { 
					jQuery("#tr_parent").show();
					
					jQuery("#td_parent").html(msg);				
				 }
				else
				 {
					jQuery("#msg1").html("Error while loading!!!");
				 }
				
				
			}
		})	 
	

}

function getChildFirst(id)
{
	var err_txt = "";
	var err = "";
	var num = 0;
	jQuery(".txtin").css({border:bbclr});
	
	var level = jQuery('#level').val()
	var path = jQuery('#path').val()+"ajax/layers.php";
	var param = "id="+id+"&level="+level+"&act=getChildFirst";
	
	
	jQuery.ajax({
		type: 	'GET',
		data: 	param,
		url:	path,
		success:function(msg){
				
				if(msg)
				 { 
					jQuery("#tr_firstChild").show();
					jQuery("#td_firstChild").html(msg);				
				 }
				else
				 {
					jQuery("#msg1").html("Error while loading!!!");
				 }
				
				
			}
		})	 
	

}

function getSecondChild(id)
{
	var err_txt = "";
	var err = "";
	var num = 0;
	jQuery(".txtin").css({border:bbclr});
	
	var level = jQuery('#level').val()
	var path = jQuery('#path').val()+"ajax/layers.php";
	var param = "id="+id+"&level="+level+"&act=getSecondChild";
	
	
	jQuery.ajax({
		type: 	'GET',
		data: 	param,
		url:	path,
		success:function(msg){
				
				if(msg)
				 { 

					jQuery("#tr_SecondChild").show();
					jQuery("#td_SecondChild").html(msg);				
				 }
				else
				 {
					jQuery("#msg1").html("Error while loading!!!");
				 }
				
				
			}
		})	 
	

}

 ;(function($) {

         // DOM Ready
        $(function() {

            // Binding a click event
            // From jQuery v.1.7.0 use .on() instead of .bind()
            $('#my-button').bind('click', function(e) {

                // Prevents the default action to be triggered. 
                e.preventDefault();

                	var lid = "";
					lid = jQuery("#layer_id").val();
					var path = jQuery('#path').val()+"ajax/cartoIdicator.php";
					var param = "act=getIndicator&lid="+lid;	
					jQuery.ajax({
						type: 	'POST',
						data: 	param,
						url:	path,
						success:function(msg){
								if(msg)
								 { 
									$('#element_to_pop_up').html(msg);
									$('#element_to_pop_up').bPopup();
								 }
								else
								 {
									jQuery("#msg1").html("Error while loading!!!");
								 }
							}
						})	
				
				// Triggering bPopup when click event is fired
               // $('#element_to_pop_up').bPopup();

            });

        });

    })(jQuery);

function selectIndicator(){
	
		var checkboxValues = [];
		jQuery('input[type="checkbox"]:checked').each(function(index, elem) {
            //console.log(jQuery(elem).val())
			
			checkboxValues.push("'"+jQuery(elem).attr('title')+"'")
			//checkboxValues.push($(elem).val());
        });
		//console.log(checkboxValues)
		jQuery('#indicator').val(checkboxValues);
		jQuery('#element_to_pop_up').html('');
		jQuery('#element_to_pop_up').bPopup().close() ;
	
	}

function getIndicator1()
{
	var err_txt = "";
	var err = "";
	var num = 0;
	jQuery(".txtin").css({border:bbclr});
	
	var path = jQuery('#path').val()+"ajax/cartoIdicator.php";
	var param = "act=getIndicator";	
	jQuery.ajax({
		type: 	'POST',
		data: 	param,
		url:	path,
		success:function(msg){
				if(msg)
				 { 
				 	$('#element_to_pop_up').html(msg);
				 	$('#element_to_pop_up').bPopup();
				 }
				else
				 {
					jQuery("#msg1").html("Error while loading!!!");
				 }
			}
		})	 
}