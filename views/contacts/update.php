<style>
    /* >>> Align all the lebels equally in Update Popup */
    .update_label {
        font-weight: bold !important;
        display: inline-block !important;
        width: 30% !important;
    }
        
    input[type='text'], input[type='date']{
        width: 51%;
    }
    
    /* >>> Customize Update popup title-bar */
    .ui-dialog-titlebar{
        background: #4aa8e4 !important;
        color: white !important;
    }
</style>

<div calss="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-update-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
	),
        'method' => 'POST',
        'focus'=>array($model,'firstName'),
    )); ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($contact,'id'); ?>
    <div class="row">
        <?php echo $form->labelEx($model,'first_name', array('class' => 'update_label')); ?>
        <?php echo $form->textField($contact,'first_name'); ?>
        <?php echo $form->error($contact,'first_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'last_name', array('class' => 'update_label')); ?>
        <?php echo $form->textField($contact,'last_name',array('value' => $contact->last_name)); ?>
        <?php echo $form->error($contact,'last_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'dob', array('class' => 'update_label')); ?>
        <?php echo $form->dateField($contact,'dob',array('value' => $contact->dob)); ?>
        <?php echo $form->error($contact,'dob'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'email', array('class' => 'update_label')); ?>
        <?php echo $form->textField($contact,'email',array('value' => $contact->email)); ?>
        <?php echo $form->error($contact,'email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'gender', array('class' => 'update_label')); ?>
        <?php echo $form->radioButtonList($contact, 'gender', $multichoice['genders'], array('value' => $contact->gender, 'separator'=>' ')); ?>
        <?php echo $form->error($contact,'gender'); ?>
        
    </div>
    <div class="row buttons">
        <?php echo CHtml::button('Update', array("id" => "update-contact-submit", "onClick" => "js:updateContact(this);")); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>

<script>
    function updateContact(obj){
        var formSerialized = $(obj).closest("form").serializeArray();
        console.log(formSerialized);
        $.post('<?php echo Yii::app()->controller->createUrl('contacts/update') ?>', formSerialized, function(ret, stat){
            if(ret){
                $.fn.yiiGridView.update("yw0");
                $("body").find("#contact-update").dialog("close");
            }
        });
        return false;
    }
</script>