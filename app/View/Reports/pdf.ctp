<?php 
	App::import('Vendor','xtcpdf');  
	
	// create new PDF document
	$tcpdf = new XTCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
	$textfont_body = 'freesansi';//'freesans'; // looks better, finer, and more condensed than 'dejavusans'
	$textfont_title = 'freesansbi';
		
	$tcpdf->SetAuthor("EdFnX - Wilmer Eddy Chambi Llica"); 
	$tcpdf->SetAutoPageBreak( true ); 
		
	//set margins
	$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$tcpdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	
	//set image scale factor
	$tcpdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	
	//set auto page breaks
	$tcpdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// ---------------------------------------------------------
	
	// set font
	// $tcpdf->xfootertext = $current_user['nombres'].' '.$current_user['ap_paterno'].' '.$current_user['ap_materno']; 
	$tcpdf->xfootertext = "Administrador";
	
	// add a page
	$tcpdf->AddPage();
	
	$tcpdf->SetFont($textfont_title, 'B', 10);
		
	$tcpdf->Write(0, 'RELACIÓN DE CONVENIOS SUSCRITOS', '', 0, 'C', true, 0, false, false, 0);
	$tcpdf->Ln(4);

	$tcpdf->SetFont($textfont_title, 'B', 8);
	
	// create columns content
	$left_column = '[LEFT COLUMN] left column'."\n";
	$right_column = '[RIGHT COLUMN] right column '."\n";
	
	// set color for background
	$tcpdf->SetFillColor(215, 235, 255);
	$tcpdf->SetTextColor(0, 0, 0);
	
	$tcpdf->Cell(7,7, "N°" ,'LT',0,'C', 1);
	$tcpdf->Cell(70,7, "Título" ,'LT',0,'C', 1); 
	$tcpdf->Cell(50,7, "Objetivos" ,'LT',0,'C', 1); 
	$tcpdf->Cell(30,7, "Responsables" ,'LT',0,'C', 1);
	$tcpdf->Cell(20,7, "Cobertura" ,'LT',0,'C', 1);
	$tcpdf->Cell(20,7, "Localidad" ,'LT',0,'C', 1);
	$tcpdf->Cell(21,7, "Suscripción" ,'LT',0,'C', 1);
	$tcpdf->Cell(29,7, "Resolución" ,'LT',0,'C', 1);
	$tcpdf->Cell(0,7, "Vigencia" ,'LRT',0,'C', 1);
	
	$tcpdf->Ln();

	// set color for background
	$tcpdf->SetFillColor(255, 255, 255);
	$tcpdf->SetFont($textfont_body, '', 8);
	
	if(empty($data)){
		$tcpdf->Cell(200,7, "No hay Agreements Registrados" ,'0',0,'C', 1);        
	}else{ 
		$i = 1;
		$final = 6;
									 
		foreach ($data as $agreement):
			if($i % $final == 0){
				$tcpdf->MultiCell(7, 23.7, $i, 'LBT', 'C', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(70, 23.7, $agreement['Agreement']['title'], 'LBT', 'L', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(50, 23.7, $agreement['Agreement']['objetives'], 'LBT', 'L', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(30, 23.7, $agreement['Agreement']['responsible'], 'LBT', 'L', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(20, 23.7, $agreement['Agreement']['coverage_type'], 'LBT', 'C', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(20, 23.7, $agreement['Agreement']['location_type'], 'LBT', 'C', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(21, 23.7, $agreement['Agreement']['suscription_date'], 'LBT', 'C', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(29, 23.7, $agreement['Agreement']['rectory_resolution'], 'LBT', 'C', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(0, 23.7, $agreement['Agreement']['is_validity'], 'LBTR', 'C', 1, 0, '', '', true, 0, false, true, 23.7, 'M');

				$tcpdf->Ln();
				$tcpdf->Cell(0, 1, "" , 0, 'C', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->Ln();
			}
			else{
				
				$tcpdf->MultiCell(7, 23.7, $i, 'LT', 'C', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(70, 23.7, $agreement['Agreement']['title'], 'LT', 'L', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(50, 23.7, $agreement['Agreement']['objetives'], 'LT', 'L', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(30, 23.7, $agreement['Agreement']['responsible'], 'LT', 'L', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(20, 23.7, $agreement['Agreement']['coverage_type'], 'LT', 'C', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(20, 23.7, $agreement['Agreement']['location_type'], 'LT', 'C', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(21, 23.7, $agreement['Agreement']['suscription_date'], 'LT', 'C', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(29, 23.7, $agreement['Agreement']['rectory_resolution'], 'LT', 'C', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->MultiCell(0, 23.7, $agreement['Agreement']['is_validity'], 'LTR', 'C', 1, 0, '', '', true, 0, false, true, 23.7, 'M');
				$tcpdf->Ln();
			}

			$i++;       
		endforeach;

		
		if($data % $final != 0){
			$tcpdf->Cell(0, 2, "" , 'T', 'C', 1, 0, '', '', true);
			$tcpdf->Ln();
		}
	 }
		
	// $tcpdf->MultisCell(0,5, 'Copyright © SYSAAPS Conduriri. Derechos Reservados.'.' '.date('Y-m-d H:i:s'),'T',1,'C');
				
	// reset pointer to the last page
	$tcpdf->lastPage();
	
	// ---------------------------------------------------------
	
	//Close and output PDF document
	$tcpdf->Output('Convenios-Suscritos-'.date('Y-m-d').'.pdf', 'D');
	
	//============================================================+
	// END OF FILE                                                
	//============================================================+
		
?>
