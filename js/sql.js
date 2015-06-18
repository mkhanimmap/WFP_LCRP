var layers = {};
var layers_vis = {};
     function main() {

$.ajax({

    url: 'http://syriainfo.cartodb.doylesolutions.ie//api/v2/sql/?q=SELECT *,(cash_leban+cash_prl+cash_prs+cash_syria+cash_vulne) as ccc FROM lebanonoutcome1&api_key=07cd04c451765f8436c0be0e24b927edb70d90fc',
    data: '',
    type: 'GET',
    crossDomain: true,
    dataType: 'jsonp',
    success: function() { alert("Success"); },
    error: function() { alert('Failed!'); },
    beforeSend: setHeader
});

/*$.getJSON('http://syriainfo.cartodb.doylesolutions.ie//api/v2/sql/?q=SELECT *,(cash_leban+cash_prl+cash_prs+cash_syria+cash_vulne) as ccc FROM lebanonoutcome1&api_key=07cd04c451765f8436c0be0e24b927edb70d90fc', function(data) {
  $.each(data.rows, function(key, val) {
    // do something!
	console.log(val)
	console.log(key)
  });
});*/
}