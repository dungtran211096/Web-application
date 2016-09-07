<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="background.css">
	<title>QR code</title>
</head>
<body>

<!-----------------------Author : Dung Tran------------------>
<div class="container">

    <div class="jumbotron">
      <div class="page-header">
        <h3>
        Hi! Welcome to our website which will help you convert seed datas to QRcode.
  </h3>
      </div>
      
      <h4> <b> Input File </b> </h4>
	<form action = "pdf_qrcode.php" method="POST" enctype="multipart/form-data">
        
        <div class="input-group">
        	<label class="input-group-btn">
            	<span class="btn btn-default">
          	    <input type="file" name="fileToUpload" id="fileToupload"  multiple>
       			 </span>
          	</label>
          	
        </div>
        
        <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Create QR code">
      </form>
    </div>
  </div>

<!---------------------------Handle file------------------------>

<?php
//is _Post['submit'] exist 
if(isset($_POST['submit'])){
	
	//is fileToUpload exist
	if(isset($_FILES['fileToUpload'])){
		
    //if not get errors, upload it
		if($_FILES['fileToUpload']['error'] > 0){
			echo "Upload fail!";
		}
		
    else { include "upload.php";}
	}
	else { echo "File isn't exist!!";}
}
?>
</body>
</html>