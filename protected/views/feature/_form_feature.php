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
        'focus'=>array($feature,'name')
    )); ?>
    
    <div class="row">
        <?php echo CHtml::link('New', array('/admin/index')); ?>
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