<?php
	session_start();

	//PDF PART
	require_once("TCPDF/tcpdf.php");

	/// Extend the TCPDF class to create custom Header and Footer
	class MYPDF extends TCPDF {

		//Page header
		public function Header() {
			// Set font
			$this->SetFont('helvetica', 'B', 20);
			// Title
			$this->Cell(0, 15, 'Halalan 127 List of Voters', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		}

	}

	// create new PDF document
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Halalan 127.');
	$pdf->SetTitle('Halalan 127 List of Voters');
	$pdf->SetSubject('Halalan 127 List of Voters');
	$pdf->SetKeywords('Halalan, 127, List, Voters');

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// ---------------------------------------------------------

	// set font
	$pdf->SetFont('times', '', 12);

	// add a page
	$pdf->AddPage();

	$link = mysqli_connect("localhost","root","","carl");
	mysqli_set_charset($link, "utf8");

	$querystr = "SELECT * FROM users ORDER BY LOWER(surname)";
	$result = mysqli_query($link, $querystr);

	$html = "";
	
	$html = "<br>". $html . "<br>" . <<<EOD
		<table border="2" align="center">
			<tr>
				<th width="35px"> </th>
				<th> Surname </th>
				<th> First Name </th>
				<th> Date of Birth </th>
				<th> Address </th>
				<th width="90px"> Contact No. </th>
				<th> Username </th>
				<th> Password </th>
			</tr>
	EOD;	
			$count = 1;
			while($row = mysqli_fetch_assoc($result)){
				$fname = $row["name"];
				$surname = $row["surname"];
				$dob = $row["date_of_birth"];
				$address = $row["address"];
				$contactno = $row["contact_number"];
				$username = $row["username"];
				$password = $row["password"];

				$html = $html . "<tr><td>" . $count . "</td><td>" . $surname . "</td><td>" . $fname . "</td><td>" . $dob . "</td><td>" . $address . "</td><td>" . $contactno . "</td><td>" . $username . "</td><td>" . $password . "</td></tr>";
				$count++;
			}
	$html = $html . "</table>";
	$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
	$pdf->Output('List of Voters.pdf', 'D');
?>