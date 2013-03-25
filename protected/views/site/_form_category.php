<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'form-category',
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                    'validateOnSubmit'=>true
        ),
        'focus'=>array($category,'firstName')
    )); ?>
    
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    
    <?php echo $form->errorSummary($category); ?>

    <div class="row">
        <?php echo $form->labelEx($category,'name'); ?>
        <?php echo $form->textField($category,'name'); ?>
        <?php echo $form->error($category,'name'); ?>
    </div>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>
    
    <?php $this->endWidget(); ?>
</div>