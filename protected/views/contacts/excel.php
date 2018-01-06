<?php
    $objPHPExcel = new PHPExcel();
    $FontColor = new PHPExcel_Style_Color();
    $FontColor->setRGB("FFFFFF");
    $sheetId = 0;
    $i = 1;
    $colid = 4;
    $sheet = $objPHPExcel->getActiveSheet();
    
    $sheet->setCellValue('A3', "  #  ");
    $sheet->setCellValue('B3', "First Name");
    $sheet->setCellValue('C3', "Last Name");
    $sheet->setCellValue('D3', "E-Mail");
    $sheet->setCellValue('E3', "Date of Birth");
    $sheet->setCellValue('F3', "Gender");
    $sheet->setCellValue('G3', "City");
    $sheet->setCellValue('H3', "State");
    $sheet->setCellValue('I3', "ZIP");
    $sheet->setCellValue('J3', "Hobbies");
    $sheet->setCellValue('K3', "Status");

    $objPHPExcel->setActiveSheetIndex($sheetId)->mergeCells('A1:K1')->mergeCells('A2:K2');
    $sheet->getStyle('A2:K2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->setCellValue('A2', 'Contact List');
    $sheet->getStyle('A2:K2')->getFont()->setSize(15)->setBold(true);
    $sheet->getStyle('A3:K3')->getFont()->setSize(11)->setBold(true);
    
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
    
    foreach($contacts as $c){
        $sheet->setCellValue('A' . $colid, $i++);
        $sheet->setCellValue('B' . $colid, $c->first_name);
        $sheet->setCellValue('C' . $colid, $c->last_name);
        $sheet->setCellValue('D' . $colid, $c->email);
        $sheet->setCellValue('E' . $colid, $c->dob);
        $sheet->setCellValue('F' . $colid, $c->gender);
        $sheet->setCellValue('G' . $colid, $c->city);
        $sheet->setCellValue('H' . $colid, $c->state);
        $sheet->setCellValue('I' . $colid, $c->zip);
        $sheet->setCellValue('J' . $colid, $c->hobbies);
        $sheet->setCellValue('K' . $colid, $c->status);
        $colid++;
    }
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ContactsList.xls"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    Yii::app()->end();
?>