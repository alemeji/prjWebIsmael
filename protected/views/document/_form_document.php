<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$this->pageTitle=Yii::app()->name . ' - Administrator - Features';

?>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'form-document',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                    'validateOnSubmit'=>true
        ),
        //'focus'=>array($feature,'name')
    )); ?>
    
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    
    <?php //echo $form->errorSummary($feature); ?>
    
    <div class="row">
        <?php echo $form->labelEx($document,'name'); ?>
        <?php echo CHtml::activeFileField($document, 'name'); ?>
        <?php echo $form->error($document,'name'); ?>
    </div>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>
    
    <?php $this->endWidget(); ?>
</div>