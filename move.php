<?php
$rootDir = realpath('/Users/immap/Downloads');
$file_name = "Dara_MA_RiskEducation.csv";
$file_name_clean = "Dara_MA_RiskEducation_clean.csv";
$fullPath = realpath($rootDir . '/' . $file_name);
$fullPath_clean = realpath($rootDir . '/' . $file_name_clean);





if (false !== ($ih = fopen($fullPath, 'r'))) {
    $oh = fopen($fullPath_clean, 'w');
fprintf($oh, chr(0xEF).chr(0xBB).chr(0xBF));
    while (false !== ($data = fgetcsv($ih))) {
        // this is where you build your new row
        unset($data[1]);
		unset($data[59]);
		//$outputData = array($data[0], $data[1], $data[4], $data[5], $data[6]);
        fputcsv($oh, $data);
    }

    fclose($ih);
    fclose($oh);
}

$cont = file_get_contents($fullPath_clean);
file_put_contents($file_name_clean, $cont);

/*if (file_exists($fullPath))
	unlink($fullPath);
	
if (file_exists($fullPath_clean))
	unlink($fullPath_clean);	*/
	
?>