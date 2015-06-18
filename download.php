<?php
$url = "http://data.unhcr.org/syrianrefugees/download.php?id=8596";
 $url = "http://172.16.5.59:8080/view/binaryData?blobKey=aggregate.opendatakit.org%3APersistentResults%5B%40version%3Dnull+and+%40uiVersion%3Dnull%5D%2F_persistent_results%5B%40key%3Duuid%3A0bc4af58-6ac5-43e6-965e-582bd26fb42c%5D&as_attachment=yes";
header("Content-Type: text/html; charset=utf-8");


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$csv_file_content = curl_exec($ch);
curl_close($ch);


$file_name = "Dara_MA_RiskEducation.csv";



header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream'); 
header('Content-Disposition: inline; filename='.$file_name);

header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
echo "\xEF\xBB\xBF"; // UTF-8 BOM
echo $csv_file_content;



exit();




?>