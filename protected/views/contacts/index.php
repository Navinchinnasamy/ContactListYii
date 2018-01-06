<?php if(Yii::app()->user->hasFlash('contact')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>
<?php endif; ?>

<?php
echo CHtml::link('<img src="'.Yii::app()->baseUrl.'/images/pdf-icon-org.png" alt="" />', array('pdf'), array('target'=>'_blank', 'class' => 'export_contacts'));
echo CHtml::link('<img src="'.Yii::app()->baseUrl.'/images/excel-icon-org.png" alt="" />', array('excel'), array('target'=>'_blank', 'class' => 'export_contacts'));

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'name' => 'First Name',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->first_name)'
        ),
        array(
            'name' => 'Last Name',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->last_name)',
        ),
        array(
            'name' => 'E-Mail',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->email)',
        ),
        array(
            'name' => 'Date of Birth',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->dob)',
        ),
        array(
            'name' => 'Gender',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->gender)',
        ),
        array(
            'name' => 'City',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->city)',
        ),
        array(
            'name' => 'State',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->state)',
        ),
        array(
            'name' => 'Zip',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->zip)',
        ),
        array(
            'name' => 'Hobbies',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->hobbies)',
        ),  
        array(
            'header'            => 'Actions',
            'type'              => 'raw',
            'htmlOptions'       => array('style' => 'text-align:center;width:75px;'),
            'headerHtmlOptions' => array('style' => 'text-align:center;'),
            'value'             => 'CHtml::imageButton(Yii::app()->baseUrl."/assets/ef9ac7c4/gridview/update.png",array("onClick"=>"js:sowUpdateView($data->primaryKey);return false;","title"=>"Edit this Contact","class"=>"contact_actions"))."&nbsp&nbsp".CHtml::imageButton(Yii::app()->baseUrl."/assets/ef9ac7c4/gridview/delete.png",array("onClick"=>"js:deleteContact($data->primaryKey);return false;","title"=>"Delete this Contact","class"=>"contact_actions"))',
        ),
//        array(
//            'class'=>'CButtonColumn',
//            'template' => '{update} {delete}',
//            'buttons' => array(
//                'update' => array(
//                    'url'=>'$this->grid->controller->createUrl("update", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
//                    'click'=>'function(){sowUpdateView(this);}',
//                )
//            )
//        ),
        
    ),
));

$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
    'id'=>'contact-update',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Contact Update',
        'autoOpen'=>false,
        'modal'=>'true',
        'width'=>'35%',
        'height'=>'auto',
    ),
));

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<script>
    function sowUpdateView(id){
        $.post('<?php echo Yii::app()->controller->createUrl('contacts/update'); ?>', {"id": id}, function(ret){
            $("body").find("#contact-update").html(ret).dialog('open');
        });
    }
    
    function deleteContact(id){
        if(confirm('Are you sure? \r\nContact will be deleted permanently and is not recoverable.')){
            $.post('<?php echo Yii::app()->controller->createUrl('contacts/delete'); ?>', {"id": id}, function(ret){
                $("body").find("#content").prepend('<div class="flash-notice">Contact has been deleted!</div>');
                $.fn.yiiGridView.update("yw0");
            });
        }
    }
</script>