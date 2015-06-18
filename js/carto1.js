var layers = {};
var layers_vis = {};
var glayers_index = [];
var layer = {};

     //function main(url,layers_index,map_center,zoom) {
	function main(url,map_center,zoom) {
		//glayers_index = layers_index;
		
		map_center = map_center.split("??")
		var center = [];
		center.push(map_center[0]);
		center.push(map_center[1]);
		
		//alert(map_center)
		var minmax = "";
		getMinMax("'DisSyr - # of vulnerable individuals receiving e-cards'",function(minmax) {
				minmax = minmax.split("?||?");
				var data_l = {};
				var min_ = Math.round(minmax[0]);
				var max_ = Math.round(minmax[1]);
				
				
				var h = Math.round((max_ - min_) / 7) ;
				
				var index = min_;
					
				var data_array = [];
					while(index <= max_)
					 {
						 data_array.push(index);
						 
						 index += h; 
						 
					 }
				console.log(data_array)
				
				
				var map =  "";
				map = new L.map('map', { 
					tiles_loader: true,
					center: center,
					zoom: zoom
				})
				// add a base layer
				//L.tileLayer('http://tile.stamen.com/toner/{z}/{x}/{y}.png', {
				  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
				  attribution: 'Stamen'
				}).addTo(map);
		
				// add cartodb layer with one sublayer
				cartodb.createLayer(map, {
				  user_name: 'syriainfo',
				  type: 'cartodb',
				  //tiler_host:'windshaft.cartodb.geonode.wfp.org',
				  sql_api_domain: "sqlapi.doylesolutions.ie",
				  sql_api_port: "80",
				  sql_api_protocol: "http",
				  tiler_domain:'windshaft.doylesolutions.ie',
				  tiler_port: '80',
				  tiler_protocol: 'http',
				  sublayers: [{
					  sql: "SELECT gov.the_geom_webmercator, indicator_name, gov.cartodb_id as code,gov.carto_name as governorates, sum(cast(value as numeric)) as val FROM ai_reports_2015_04_14_07_22 ai  inner join governorates_8 gov on ai.governorate = gov.carto_name where indicator_name in ('DisSyr - # of vulnerable individuals receiving e-cards') group by governorates,gov.the_geom_webmercator,code,indicator_name",
             cartocss: '#vasyr {  polygon-opacity: 0.7;line-color: #FFF;line-width: 1;line-opacity: 1;}#vasyr[code=2] {   polygon-fill: #A6CEE3;}#vasyr[code=4] {   polygon-fill: #f7b794;}#vasyr[code=1] {   polygon-fill: #e2efe9;}#vasyr[code=3] {   polygon-fill: #d2cae3;}#vasyr[code=5] {   polygon-fill: #FB9A99;}',
			//cartocss: '#vasyr{polygon-fill: #FFFFB2;polygon-opacity: 0.1;line-color: #FFF;line-width: 1;line-opacity: 1;}#vasyr [ val <= '+data_array[0]+'] {polygon-fill: #B10026;}#vasyr [ val <= '+data_array[1]+'] {polygon-fill: #E31A1C;}#vasyr [ val <= '+data_array[2]+'] {polygon-fill: #FC4E2A;}#vasyr [ val <= '+data_array[3]+'] {polygon-fill: #FD8D3C;}#vasyr [ val <= '+data_array[4]+'] {polygon-fill: #FEB24C;}#vasyr [ val <= '+data_array[5]+'] {   polygon-fill: #FED976;}#vasyr [ val <= '+data_array[6]+'] {polygon-fill: #FFFFB2;}',
					 interactivity: 'governorates,indicator_name,val',
					 infowindow: true
					 }]
				},{no_cdn: true})
				.addTo(map)
				.done(function(layer) {
				  //cartodb.vis.Vis.addInfowindow(map, layer.getSubLayer(0), ['fcs_accept']);
				  var legend = new cdb.geo.ui.Legend({
				   type: "custom",
				   data: [
					 { name: "Category 1", value: "#FFC926" },
					 { name: "Category 2", value: "#76EC00" },
					 { name: "Category 3", value: "#00BAF8" },
					 { name: "Category 4", value: "#D04CFD" }
				   ]
				 });
        		 $('#map').append(legend.render().el);
				 
				  cdb.vis.Vis.addInfowindow(map, layer.getSubLayer(0), ['governorates','indicator_name','val']);
				
				}).error(function(err) {
				  alert(err);
				});
		
		
		
		console.log(minmax)
		});
      }
	  
	  
function getMinMax(indicator,callback)
	 {
		var path = jQuery('#path').val()+"ajax/filter.php";
		var param = "indicator="+indicator+"&act=getminmax";
		
		msg = "";
		jQuery.ajax({
			type: 	'POST',
			data: 	param,
			url:	path,
			success:function(msg){
					if(msg)
					 {
						//msg = msg.split("?||?");
						if (callback) {
						 callback(msg);
						}
					 }
					else
					 {
						
						alert("Error while loading url!!!");
					 }
					
					
				}
		
			//window.location.href = "test.php?cid";
	 	});
	 
	 	if(msg)
		 return msg;
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
			
			if(indicator)
			 {
					loadPartner(indicator);
					getByYear(indicator);
					loadBeneficiaryGroup(indicator);
					loadLayer(indicator,'','');
			 }
			})	
		  }) 
		  

function loadLayer(indicator,partner,benGroup,year,month)
{
				
				jQuery("#div_map").html('');
				jQuery("#div_map").html('<div  id="map" style="width: 77%; height: 93%; position: absolute;border-left: #c9c5c5 10px solid;box-shadow: 0 5px 0 #c9c5c5;"></div>');
				
				var map =  "";
				map = new L.map('map', { 
				  
					tiles_loader: true,
					center: [33.906896,35.771484],
					//center: center,
					//zoom: zoom
					zoom: 9
				})
				L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
						
						//L.tileLayer('http://{s}.tile.openweathermap.org/map/clouds/{z}/{x}/{y}.png', {
				  attribution: 'Stamen'
				}).addTo(map);
				
				var l_sql = "";
				l_sql = "SELECT gov.the_geom_webmercator, gov.cartodb_id as code,gov.carto_name as governorates,ai.indicator_name as ind_name, sum(cast(value as numeric)) as val FROM ai_reports_2015_04_14_07_22 ai  inner join governorates_8 gov on ai.governorate = gov.carto_name where indicator_name in ("+indicator+")";
				
				if(partner)
				 l_sql +=" and partner_id='"+partner+"'";
				if(year)
				 l_sql +=" and trim((string_to_array(date, '-'))[1])='"+year+"'";
				if(month)
				 l_sql +=" and trim((string_to_array(date, '-'))[2])='"+month+"'";
				if(benGroup)
				 l_sql +=" and trim((string_to_array(indicator_name, ' '))[1]) = trim((string_to_array('"+benGroup+"', '-'))[1])";
				 l_sql +=" group by governorates,gov.the_geom_webmercator,code,ind_name";
				console.log(l_sql)
				
				cartodb.createLayer(map, {
				  user_name: 'syriainfo',
				  type: 'cartodb',
				  //tiler_host:'windshaft.cartodb.geonode.wfp.org',
				  sql_api_domain: "sqlapi.doylesolutions.ie",
				  sql_api_port: "80",
				  sql_api_protocol: "http",
				  tiler_domain:'windshaft.doylesolutions.ie',
				  tiler_port: '80',
				  tiler_protocol: 'http',
				  sublayers: [{
					 //sql: "SELECT * FROM vasyr where adm2_code in(18791,18797,18804)",
					  sql: l_sql,
             //cartocss: '#vasyr {  polygon-opacity: 0.7;line-color: #FFF;line-width: 1;line-opacity: 1;}#vasyr[code=2] {   polygon-fill: #A6CEE3;}#vasyr[code=4] {   polygon-fill: #f7b794;}#vasyr[code=1] {   polygon-fill: #e2efe9;}#vasyr[code=3] {   polygon-fill: #d2cae3;}#vasyr[code=5] {   polygon-fill: #FB9A99;}',
			 cartocss: '#vasyr {polygon-opacity: 0.6;line-color: #FFF;line-width: 1;line-opacity: 1;}#vasyr[governorates="Beyrouth"] {polygon-fill: #A6CEE3;}#vasyr[governorates="Nabatiye"] {polygon-fill: #1F78B4;}#vasyr[governorates="Sud"] {polygon-fill: #B2DF8A;}#vasyr[governorates="Akkar"] {polygon-fill: #33A02C;}#vasyr[governorates="Mont Liban"] {polygon-fill: #FB9A99;}#vasyr[governorates="Nord"] {polygon-fill: #E31A1C;}#vasyr[governorates="Bekaa"] {polygon-fill: #FDBF6F;}#vasyr[governorates="Baalbek_Hermel"] {polygon-fill: #FF7F00;}',
					 interactivity: 'governorates,ind_name,val',
					 infowindow: true
					 }]
				},{no_cdn: true})
				.addTo(map)
				.done(function(layer) {
				 console.log(layer)
				  //cartodb.vis.Vis.addInfowindow(map, layer.getSubLayer(0), ['fcs_accept']);
				  cdb.vis.Vis.addInfowindow(map, layer.getSubLayer(0), ['governorates','ind_name','val']);
				}).error(function(err) {
				  alert(err);
				});

}	

function loadBeneficiaryGroup(indicator)
{
		indicator =  indicator.replace("&", "and");
		var act = 'BeneficiaryGroup';
		var param = "act=BeneficiaryGroup&indicator="+indicator;
		var path = jQuery('#path').val()+"ajax/filter.php";
		jQuery.ajax({
			type: 	'POST',
			data: 	param,
			url:	path,
			success:function(msg){
					
					if(msg)
					 {
						jQuery("#divBeneficiaryGroup").html(msg)
					 }
					else
					 {
						jQuery("#divBeneficiaryGroup").html('')
						//jQuery('#error_').html("Username/Password Is Incorrect");
						//alert("Error while ogin!!!");
					 }
					
					
				}
		
			//window.location.href = "test.php?cid";
		});
	
}

function loadPartner(indicator) 
{
		indicator =  indicator.replace("&", "and");
		var act = 'Partner';
		var param = "act=Partner&indicator="+indicator;
	   var path = jQuery('#path').val()+"ajax/filter.php";
		
		jQuery.ajax({
			type: 	'POST',
			data: 	param,
			url:	path,
			success:function(msg){
					
					if(msg)
					 {
						jQuery("#divPartner").html(msg)
					 }
					else
					 {
						 jQuery("#divPartner").html('')
						//jQuery('#error_').html("Username/Password Is Incorrect");
						//alert("Error while ogin!!!");
					 }
					
					
				}
		
			//window.location.href = "test.php?cid";
		});

}

function getByYear(yid) 
{
		
	var indicator = "";
	var BeneficiaryGroup = "";
	var partner = ""
	var month = "";
	BeneficiaryGroup = jQuery("#BeneficiaryGroup").val();
	partner = jQuery("#partner").val();
	month = jQuery("#month").val();
	jQuery( "input[id*='li_']" ).each(function(index, element) {
		if (jQuery(this).is(':checked'))
		 {
			indicator = $(this).parents().get(0).rel;			
		 }    
     });
	 
	 loadLayer(indicator,partner,BeneficiaryGroup,yid,month);
		/*var act = 'year';
		var param = "act=year&indicator="+indicator;
	   var path = jQuery('#path').val()+"ajax/filter.php";
		
		jQuery.ajax({
			type: 	'POST',
			data: 	param,
			url:	path,
			success:function(msg){
					
					if(msg)
					 {
						jQuery("#divYear").html(msg)
					 }
					else
					 {
						 jQuery("#divYear").html('')
						//jQuery('#error_').html("Username/Password Is Incorrect");
						//alert("Error while ogin!!!");
					 }
					
					
				}
		
			//window.location.href = "test.php?cid";
		});*/
}
function getByMonth(mid) 
{
	var indicator = "";
	var BeneficiaryGroup = ""
	var partner = "";
	year = "";
	BeneficiaryGroup = jQuery("#BeneficiaryGroup").val();
	partner = jQuery("#partner").val();
	year = jQuery("#year").val();
	
	jQuery( "input[id*='li_']" ).each(function(index, element) {
		if (jQuery(this).is(':checked'))
		 {
			indicator = $(this).parents().get(0).rel;			
		 }    
    });
	
	loadLayer(indicator,partner,BeneficiaryGroup,year,mid);
	
	  /* var param = "act=month&indicator="+indicator;
	   var path = jQuery('#path').val()+"ajax/filter.php";
		jQuery.ajax({
			type: 	'POST',
			data: 	param,
			url:	path,
			success:function(msg){
					if(msg)
					 {
						jQuery("#divMonth").html(msg)
					 }
					else
					 {
						 jQuery("#divMonth").html('')
					 }
				}
		});*/
}
function getByPartner(id)	  
{
	var indicator = "";
	var BeneficiaryGroup = ""
	var year = "";
	var month = "";
	BeneficiaryGroup = jQuery("#BeneficiaryGroup").val();
	year = jQuery("#year").val();
	month = jQuery("#month").val();
	jQuery( "input[id*='li_']" ).each(function(index, element) {
		if (jQuery(this).is(':checked'))
		 {
			indicator = $(this).parents().get(0).rel;			
		 }    
    });
	
	loadLayer(indicator,id,BeneficiaryGroup,year,month);
	
}
		  
function getBeneficiaryGroup(id)	  
{
	var indicator = "";
	var partner = ""
	var year = "";
	var month = "";
	partner = jQuery("#partner").val();
	year = jQuery("#year").val();
	month = jQuery("#month").val();
	jQuery( "input[id*='li_']" ).each(function(index, element) {
		if (jQuery(this).is(':checked'))
		 {
			indicator = $(this).parents().get(0).rel;			
		 }    
    });
	
	loadLayer(indicator,partner,id,year,month);
	
}	  