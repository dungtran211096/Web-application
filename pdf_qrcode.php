<?php
//======================================
//author : Dung Tran
//target : create qrcode from csv file
//======================================



move_uploaded_file($_FILES['fileToUpload']['tmp_name'], '../html'.$_FILES['fileToUpload']['name']);
					
$file_handle = fopen('../html'.$_FILES['fileToUpload']['name'], "r");
					
//read till the end of the file
while(!feof($file_handle)){
	
	include "TCPDF/tcpdf.php";
//create new PDF document
	$pdf = new tcpdf();
	
//set document infomation
	$pdf -> SetAuthor('Dung Tran');
	$pdf -> SetTitle('Qrcode');

//set default header data
	$pdf -> SetHeaderData(0,0, "Dung Tran", "Qrcode");

//set header and footer fonts
	$pdf -> setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf -> setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set margins
	$pdf -> SetMargins(20, 20, 30);
	$pdf -> SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf -> SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set font 
	$pdf -> setFont('Times', 13);

//-------------------------------------------------------

//add a page
	$pdf -> AddPage();
/**
* @param $row (int) row excel
* @param $line_of_text : get file to handle
* @param $token (str) is data that encrypted code
**/
	$row = 1; 
	$h = 0;
//duyet tu file csv
	while($line_of_text = fgetcsv($file_handle, 1024)){

		if($row > 1){
		//take data from column 0
		   	$data = $line_of_text[0];

	  	//convert string to code 
		   	require_once (dirname(__FILE__).'/create_qrcode.php');
			
			$token = new Converts();	
			$token -> ConvertStrtoCode($data);
			$code = $token -> DisplayConvert();
			
		//export image
			require_once (dirname(__FILE__).'/phpqrcode/qrlib.php');
			
			Qrcode::png($code, '../$data.png');
			
		//import pdf	
			//if(){
			$pdf -> image('../$data.png', '','', 20, 20, 'PNG');
			
			$pdf-> write(45.5, ' '.$data);
			//}

		}
		else $row++;

	}
	$pdf -> Output('Qrcode.pdf');


	fclose($file_handle);
}	

?>
