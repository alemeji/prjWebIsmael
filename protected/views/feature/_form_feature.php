<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$this->pageTitle=Yii::app()->name . ' - Administrator - Features';

?>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'form-feature',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                    'validateOnSubmit'=>true
        ),
        'focus'=>array($feature,'firstName')
    )); ?>
    
    <div class="row">
        <?php echo CHtml::link('New', array('/admin/index')); ?>
    </div>
    <div class="alert" id="alert_feature">
        <strong>Warning!</strong> La caracteristica ya existe.
    </div>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    
    <?php echo $form->errorSummary($feature); ?>
    
    <div class="row">
        <?php //echo $form->labelEx($feature,'id'); ?>
        <?php echo $form->hiddenField($feature,'id'); ?>
        <?php echo $form->error($feature,'id'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($feature,'name'); ?>
        <?php echo $form->textField($feature,'name'); ?>
        <?php echo $form->error($feature,'name'); ?>
    </div>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>
    
    <?php $this->endWidget(); ?>
</div>

<script>
    var result = 3;
    $("#alert_feature").hide();
    
    $("#form-feature").submit(function(){
        if(result == 1){
            return false;
        }
    })
    
    $("#Feature_name").blur(function(){
        name = $("#Feature_name").val();
        $.ajax({
           type:'POST',
           url:'<?php echo Yii::app()->createUrl('/feature/verify'); ?>',
           data:{'name':name},
           dataType: 'json',
           success: function(data){
               //console.log(data);
               result = data;
               if(result == 1){
                   $("#alert_feature").show();
               }else{
                   $("#alert_feature").hide();
               }
           },
           error: function(data){
               //alert('error');
           }
       });
    });
</script>