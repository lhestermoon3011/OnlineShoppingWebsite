<?php
	try{
		$conn = NEW PDO("mysql:host=localhost;dbname=guimaras_db","root","");
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $a){
		$message = $a->getMessage();
	}
?>