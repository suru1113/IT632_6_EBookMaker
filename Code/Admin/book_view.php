<?php

    include "../database/connect.php";

    $bid = $_GET['id'];
    $que1 = mysqli_query($con, "SELECT * FROM ebook_data WHERE book_id=$bid");
    $res1 = mysqli_fetch_array($que1);

    $authorId = $res1['author_id'];
    $que2 = mysqli_query($con, "SELECT * FROM author_data WHERE author_id=$authorId");
    $res2 = mysqli_fetch_array($que2);

	// Include the main TCPDF library (search for installation path).
	require_once('../TCPDF-main/examples/tcpdf_include.php');

	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor($res2['author_first_name'] . $res2['author_last_name'] );
	$pdf->SetTitle($res1['book_title']);

	// set default header data
	// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
	$pdf->SetHeaderData("", PDF_HEADER_LOGO_WIDTH, $res1['book_title'],$res2['author_first_name'] . " " . $res2['author_last_name'] );

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(20, 20, 20);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// add a page
	$pdf->AddPage();

	$html = file_get_contents('../BookCover/' . $res1['book_cover'] . ".php");
	// $html = "<img src=''/>";
	 
	$pdf->writeHTML($html, true, false, true, false, '');
	
    // add a page
	$pdf->AddPage();

	$html = $res1['book_data'];
	
	$pdf->writeHTML($html, true, false, true, false, '');

	// reset pointer to the last page
	$pdf->lastPage();
	//Close and output PDF document
	$pdf->Output('YourBook.pdf', 'I');

?>