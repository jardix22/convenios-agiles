<?php
// create new empty worksheet and set default font
$this->PhpExcel->createWorksheet()->setDefaultFont('Calibri', 12);

// define table cells
$table = array(
    array('label' => __('Nombre'), 'width' => 50, 'wrap' => true),
    array('label' => __('Edad'), 'filter' => true),
    array('label' => __('DNI'), 'width' => 50)
    // array('label' => __('Description'), 'width' => 50, 'wrap' => true),
    // array('label' => __('Modified'))
);

// add heading with different font and bold text
$this->PhpExcel->addTableHeader($table, array('name' => 'Cambria', 'bold' => true));

// add data
foreach ($data as $d) {
    $this->PhpExcel->addTableRow(array(
        $d['Nombre'],
        $d['Edad'],
        $d['DNI']
        // $d['User']['description'],
        // $d['User']['modified']
    ));
}

// close table and output
$this->PhpExcel->addTableFooter()->output();

?>