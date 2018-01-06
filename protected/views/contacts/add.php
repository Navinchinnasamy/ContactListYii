<style>
    /* >>> Customize the Submit button */
    .submit_button {
        border-radius: 5px;
        padding: 8px;
        border: 1px;
        background-color: #5da2ca;
        font-weight: bold;
        color: white;
    }
</style>
<?php
$this->pageTitle=Yii::app()->name . ' - Contact Add';
$this->breadcrumbs=array(
	'Contact - Add',
);
?>
<h1>Contact - Add</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>
<?php else: ?>
<fieldset> 
    <div calss="form">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'contact-form',
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
            'method' => 'POST',
            'focus'=>array($model,'firstName'),
        )); ?>
        <p class="note">Fields with <span class="required">*</span> are required.</p>
        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'first_name',array('class' => 'input_label')); ?>
            <?php echo $form->textField($model,'first_name'); ?>
            <?php echo $form->error($model,'first_name'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'last_name',array('class' => 'input_label')); ?>
            <?php echo $form->textField($model,'last_name'); ?>
            <?php echo $form->error($model,'last_name'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'dob',array('class' => 'input_label')); ?>
            <?php echo $form->dateField($model,'dob'); ?>
            <?php echo $form->error($model,'dob'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'email',array('class' => 'input_label')); ?>
            <?php echo $form->textField($model,'email'); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'city',array('class' => 'input_label')); ?>
            <?php echo $form->textField($model,'city'); ?>
            <?php echo $form->error($model,'city'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'state',array('class' => 'input_label')); ?>
            <?php echo $form->dropdownList($model,'state',$stateslist); ?>
            <?php echo $form->error($model,'state'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'zip',array('class' => 'input_label')); ?>
            <?php echo $form->textField($model,'zip'); ?>
            <?php echo $form->error($model,'zip'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'gender',array('class' => 'input_label')); ?>
            <?php echo $form->radioButtonList($model,'gender', $genders, array('separator'=>' ')); ?>
            <?php echo $form->error($model,'gender'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'hobbies',array('class' => 'input_label')); ?>
            <?php echo $form->checkBoxList($model,'hobbies',$hobbies, array('separator'=>' ')); ?>
            <?php echo $form->error($model,'hobbies'); ?>
        </div>
        <div class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'submit_button')); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</fieldset>
<?php endif; ?>

