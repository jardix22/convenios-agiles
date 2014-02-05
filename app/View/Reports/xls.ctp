<?php
    // create new empty worksheet and set default font
    $this->PhpExcel->createWorksheet()->setDefaultFont('Calibri', 11);

    // Set cell A1 with a string value
    $this->PhpExcel->getActiveSheet()->setCellValue('A1', 'PHPExcel');
    $this->PhpExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);


    // define table cells
    $table = array(
        array('label' => __('N°')),
        array('label' => __('Titulo de convenio'), 'wrap' => true, 'width' => 40),
        array('label' => __('Objetivo(s)'), 'wrap' => true, 'width' => 60),
        array('label' => __('Responsable(s)'), 'wrap' => true, 'width' => 30),
        array('label' => __('Tipo')),
        array('label' => __('Localización')),
        array('label' => __('Vigencia')),
        array('label' => __('Estado de vigencia')),
        // array('label' => __('Description'), 'width' => 50, 'wrap' => true),
    );

    // add heading with different font and bold text
    $this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));

    // add data
    $i = 1;

    foreach ($data as $agreement) {
    // foreach ($data as $d) {
        $this->PhpExcel->addTableRow(array(
            $i,
            $agreement['Agreement']['title'],
            $agreement['Agreement']['objetives'],
            $agreement['Agreement']['responsible'],
            $agreement['Agreement']['coverage_type'],
            $agreement['Agreement']['location_type'],
            $agreement['Agreement']['validity'],
            $agreement['Agreement']['is_validity']
            // $agreement['User']['modified']
        ));

        $i++;
    }

    // close table and output
    $this->PhpExcel->addTableFooter()->output();
?>