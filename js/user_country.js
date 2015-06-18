// JavaScript Document
function addPrivilege()
{
	var country = jQuery("#country");	
	var uid = jQuery("#uid");
	var err_txt = "";
	var err = "";
	var num = 0;
	jQuery(".txtin").css({border:bbclr});
	jQuery("#msgError").html('').hide('slow');
	if(country.val() == "" )
		{
			num++;
			country.css({border:bclr});
			err_txt = err_txt+num+"- Please select country.<br>";
			err = 1;
			
		}
	
	if(err == 1)
			 {
				//id  = jQuery(this).attr('id');.fadeOut(5000)
				pos = jQuery('.maintbl').offset();
				jQuery('html,body').animate({scrollTop: pos.top}, 1000);
				 jQuery('#msgError').html(err_txt).fadeIn('slow');	
				 return false;
			 }
			else
			 {
				var path = jQuery('#path').val()+"ajax/addUCountry.php";
				var param = "country="+country.val()+"&uid="+uid.val()+"&act=addUCountry";
				
				jQuery.ajax({
					type: 	'GET',
					data: 	param,
					url:	path,
					success:function(msg){
							
							if(msg != 0 && msg != 2)
							 { 
								jQuery("#last_row").after(msg);					
							 }
							else if(msg == 2)
							 {
								 jQuery("#msgError").html("You have already Privileges for the selected country!!").show('slow');
							 }
							else
							 {
								jQuery("#msgError").html("Error while adding!!!").show('slow');
							 }
							
							
						}
					})	  
				
				
				//frmreg.submit(); 
				
			 }		
	
}



function delUCountry(id)
{
	jQuery("#msgError").html('').hide('slow');
	var path = jQuery('#path').val()+"ajax/addUCountry.php";
	var param = "uid="+id+"&act=del";
	
	jQuery.ajax({
		type: 	'GET',
		data: 	param,
		url:	path,
		success:function(msg){
				
				if(msg == 1)
				 { 
					jQuery("#row_"+id).fadeOut("slow");				
				 }
				else
				 {
					jQuery("#msg1").html("Error while deleting!!!");
				 }
				
				
			}
		})	  
}