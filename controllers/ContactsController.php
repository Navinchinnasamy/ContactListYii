<?php

class ContactsController extends Controller {
    private $multichoice = array('stateslist' => array('1' => 'Tamilnadu', '2' => 'Kerala', '3' => 'Karnataka', '4' => 'Andhra Pradesh'),
            'genders' => array('m' => 'Male', 'f' => 'Female', 'o' => 'Other'),
            'hobbies' => array('tv' => 'Watching TV', 'games' => 'Playing Games', 'sleep' => 'Sleeping'));
    
    public function actionIndex() {
        $model=new Contacts;
        $rawData=$model->findAll(array('condition' => "status = 'active'"));
        
        foreach ($rawData as $key => $row){
            $rawData[$key]->gender = $this->multichoice['genders'][$row->gender];
            $rawData[$key]->state = $this->multichoice['stateslist'][$row->state];
            $rawData[$key]->dob = date('d/m/Y', strtotime($row->dob));
            $hobbies = explode(',', $row->hobbies);
            $hobbies_text = '';
            foreach($hobbies as $h){
                if(trim($h))
                    $hobbies_text .=  $this->multichoice['hobbies'][$h].', ';
            }
            $rawData[$key]->hobbies = trim($hobbies_text);
        }
        
	$arrayDataProvider=new CArrayDataProvider($rawData, array(
            'id'=>'id',
            'sort'=>array(
                'attributes'=>array(
                    'first_name', 'last_name',
                ),
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
	));

	$params =array(
            'dataProvider'=>$arrayDataProvider,
            'model'=>$model, 
	);
        
        $this->render('index', $params);
    }
    
    public function actionAdd(){
        $model=new Contacts;
        if(isset($_POST['Contacts'])){
            $_POST['Contacts']['hobbies'] = implode(',', $_POST['Contacts']['hobbies']);
            $model->attributes=$_POST['Contacts'];
            $model->hobbies = $_POST['Contacts']['hobbies'];
            if($model->validate())
            {
                $model->save();
                Yii::app()->user->setFlash('contact','Contact has been added successfully.');
                //$this->refresh();
                $this->redirect(array('contacts/index'));
            }
        }
        $this->render("add", array(
            'model'=>$model, 
            'stateslist' => $this->multichoice['stateslist'],
            'genders' => $this->multichoice['genders'],
            'hobbies' => $this->multichoice['hobbies']
            )
        );
    }
    
    public function actionUpdate(){
        if(isset($_POST['Contacts'])){
            $ret = Contacts::model()->updateByPk($_POST['Contacts']['id'], $_POST['Contacts']);
            print_r(json_encode($ret)); exit;
        }
        $model = new Contacts;
        $id = $_POST['id'];
        $contact = Contacts::model()->findByPk($id);
        $this->renderPartial('update', array('model' => $model, 'multichoice' => $this->multichoice, 'contact' => $contact));
    }
    
    public function actionDelete(){
//        Contacts::model()->findByPk($_POST['id'])->delete();
        $ret = Contacts::model()->updateByPk($_POST['id'], array('status' => 'inactive'));
        print_r(json_encode($ret)); exit;
    }
    
    public function actionPdf(){
        $contacts = Contacts::model()->findAll();
        foreach ($contacts as $key => $row){
            $contacts[$key]->gender = $this->multichoice['genders'][$row->gender];
            $contacts[$key]->state = $this->multichoice['stateslist'][$row->state];
            $contacts[$key]->dob = date('d/m/Y', strtotime($row->dob));
            $hobbies = explode(',', $row->hobbies);
            $hobbies_text = '';
            foreach($hobbies as $h){
                if(trim($h))
                    $hobbies_text .=  $this->multichoice['hobbies'][$h].', ';
            }
            $contacts[$key]->hobbies = trim($hobbies_text);
        }
        
        $parameters = array(
            'contacts' => $contacts
        );
        
        $html = $this->renderPartial('pdf', $parameters, true);

        $pdf = Yii::createComponent('application.extensions.tcpdf.tcpdf', 'L');
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Yii::app()->name);
        $pdf->SetTitle('Contacts List');
        $pdf->SetSubject('Contacts List');
        $pdf->SetHeaderData('', 0, "Report", '');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Report by " . Yii::app()->name, "");
        $pdf->setHeaderFont(Array('helvetica', '', 8));
        $pdf->setFooterFont(Array('helvetica', '', 6));
        $pdf->SetMargins(15, 18, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->SetFont('dejavusans', '', 7);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->LastPage();
        $pdf->Output("Contacts.pdf", "I");
    }
    
    public function actionExcel(){
        $contacts = Contacts::model()->findAll();
        foreach ($contacts as $key => $row){
            $contacts[$key]->gender = $this->multichoice['genders'][$row->gender];
            $contacts[$key]->state = $this->multichoice['stateslist'][$row->state];
            $contacts[$key]->dob = date('d/m/Y', strtotime($row->dob));
            $hobbies = explode(',', $row->hobbies);
            $hobbies_text = '';
            foreach($hobbies as $h){
                if(trim($h))
                    $hobbies_text .=  $this->multichoice['hobbies'][$h].', ';
            }
            $contacts[$key]->hobbies = trim($hobbies_text);
        }
        
        $parameters = array(
            'contacts' => $contacts
        );
                
        Yii::app()->request->sendFile('ContactsList.xls', $this->renderPartial('excel', array(
                    'contacts' => $contacts
                        ), true)
        );

//        $html = $this->renderPartial('excel', $parameters);
        
    }
}
