// JavaScript Document
function passChange()
 {
	jQuery("#main").hide();
	jQuery("#pass").show();
	jQuery("#lpass").hide();
	jQuery("#luser").show();
 }
 
function userChange()
 {
	jQuery("#main").show();
	jQuery("#pass").hide();
	jQuery("#lpass").show();
	jQuery("#luser").hide();
 } 

function chkPass()
{
	
	jQuery(".txtin").css({border:bbclr});
	var password = jQuery("#password");	
	var cpassword = jQuery("#cpassword");
	var err_txt = "";
	var err = "";
	var num = 0;
	
	if(password.val() == "" )
		{
			num++;
			password.css({border:bclr});
			err_txt = err_txt+num+"- Password can't be blank<br>";
			err = 1;
			
		}
			
		if(cpassword.val() == "" )
		{
			num++;
			cpassword.css({border:bclr});
			err_txt = err_txt+num+"- Confirm password can't be blank<br>";
			err = 1;
			
		}
		
		if(password.val()  && cpassword.val())
		 {
			if(password.val() != cpassword.val())
			 {
				 num++;
				 cpassword.css({border:bclr});
				 err_txt = err_txt+num+"- Password mismatch<br>";
				 err = 1;
			 } 
		 }
		 
		 
		if(err == 1)
			 {
				//id  = jQuery(this).attr('id');.fadeOut(5000)
				pos = jQuery('.maintbl').offset();
				jQuery('html,body').animate({scrollTop: pos.top}, 1000);
				 jQuery('#err').show().html(err_txt);	
				 return false;
			 }
			else
			 {
				 return true;
			 }
		
}
 
function chkUsername(name)
 {
	
	if(!name)
	 {
		 jQuery("#un_msg").removeClass("success")
		 jQuery("#un_msg").addClass("error1")
		 jQuery("#un_msg").html("Username can't be blank!");	
		 return false;
	 }
	
	var path = jQuery('#path').val()+"ajax/chk_signup.php";
	var param = "name="+name+"&act=username";
	
	
	jQuery.ajax({
		type: 	'POST',
		data: 	param,
		url:	path,
		success:function(msg){
				
				if(msg == 1)
				 { 
					jQuery("#un_msg").addClass("success")
					jQuery("#un_msg").html("Username available!");							
				 }
				else
				 {
					jQuery("#un_msg").addClass("error1")
					jQuery("#un_msg").html("Username "+name+" already taken.");	
					jQuery("#username").val("")
				 }
				
				
			}
		})	  
 }

function chkUser()
{
	var name = jQuery("#name");	
	var username = jQuery("#username");	
	var password = jQuery("#password");	
	var cpassword = jQuery("#cpassword");	
	var email = jQuery("#email");	
	var org = jQuery("#organization");
	
	var err_txt = "";
	var err = "";
	var num = 0;
		
		//jQuery(".search-field").css({border:bbclr});			 	
		jQuery(".txtin").css({border:bbclr});
		jQuery("#un_msg").removeClass('error1')
		jQuery("#un_msg").removeClass('success')
		jQuery("#un_msg").html('');
		if(name.val() == "" )
		{
			num++;
			name.css({border:bclr});
			err_txt = err_txt+num+"- Full name can't be blank<br>";
			err = 1;
			
		}	
		
		if(username.val() == "" )
		{
			num++;
			username.css({border:bclr});
			err_txt = err_txt+num+"- Username can't be blank<br>";
			err = 1;
			
		}
			
		if(password.val() == "" )
		{
			num++;
			password.css({border:bclr});
			err_txt = err_txt+num+"- Password can't be blank<br>";
			err = 1;
			
		}
			
		if(cpassword.val() == "" )
		{
			num++;
			cpassword.css({border:bclr});
			err_txt = err_txt+num+"- Confirm password can't be blank<br>";
			err = 1;
			
		}
		
		if(password.val()  && cpassword.val())
		 {
			if(password.val() != cpassword.val())
			 {
				 num++;
				 cpassword.css({border:bclr});
				 err_txt = err_txt+num+"- Password mismatch<br>";
				 err = 1;
			 } 
		 }
		 	
		if(email.val() == "" )
		{
			num++;
			email.css({border:bclr});
			err_txt = err_txt+num+"- Email can't be blank<br>";
			err = 1;
			
		} 
		
		if(email.val())
		 {
			if(!email_chk.test(email.val()))
			{
				num++;
				email.css({border:bclr});
				err_txt = err_txt+num+"- Invalid email, please enter your email <br>";
				err = 1;
				
			}
		 }
		
		if(org.val() == ""  )
				{
					num++;
					org.css({border:bclr});
					err_txt = err_txt+num+"- Please select organization <br>";
					err = 1;
					
				}													
			
			if(err == 1)
			 {
				//id  = jQuery(this).attr('id');.fadeOut(5000)
				pos = jQuery('.maintbl').offset();
				jQuery('html,body').animate({scrollTop: pos.top}, 1000);
				 jQuery('#err').show().html(err_txt);	
				 return false;
			 }
			else
			 {
				var path = jQuery('#path').val()+"ajax/chk_signup.php";
				var param = "name="+username.val()+"&act=username";
				
				jQuery.ajax({
					type: 	'POST',
					data: 	param,
					url:	path,
					success:function(msg){
							
							if(msg == 1)
							 { 
								return true;							
							 }
							else
							 {
								jQuery("#un_msg").addClass("error1")
								jQuery("#un_msg").html("Username "+name+" already taken.");	
								jQuery("#username").val("")
								return false;
							 }
							
							
						}
					})	  
				
				
				//frmreg.submit(); 
				
			 }		
		
}