<?php 



if(isset($_POST["Export"])){

		 header('Content-Type: text/csv; charset=utf8_general_ci');
		 header('Content-Disposition: attachment; filename=Email4Newsletter.csv');
		 $output = fopen("php://output", "w");

		 ob_end_clean();

		 fputcsv($output, array_map("utf8_decode",array('Email','Nom','Prénom')),",");
		 $result = mysqli_query($PFM['db']['link'], "SELECT Email,Nom,Prenom FROM $TableMembres WHERE Newsletter=1");
		 while($row = mysqli_fetch_assoc($result))
		 {
					fputcsv($output, array_map("utf8_decode",$row));
		 }
		 fclose($output);
}
