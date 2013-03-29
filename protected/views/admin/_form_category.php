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
        'focus'=>array($category,'name')
    )); ?>
    
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    
    <?php echo $form->errorSummary($category); ?>

    <div class="row">
        <?php echo $form->labelEx($category,'name'); ?>
        <?php echo $form->textField($category,'name'); ?>
        <?php echo $form->error($category,'name'); ?>
    </div>
    <div class="row">
        <?php echo "Parent ?"; ?>
        <?php echo CHtml::checkBox('chkParent',false); ?>
    </div>
    <?php 
    
    ?>
    <div class="row">
        <?php 
            //echo CHtml::Label('Parent','',array('id'=>'lblParent'));
            $models = Category::model()->findAll( array('order' => 'name'));
            $list = CHtml::listData($models, 'id', 'name');  
            $parent = "";
            echo CHtml::dropDownList('subcategorys', $parent, 
                      $list,
                      array('empty' => '(Select parent category)'));
        ?>
    </div>
   
    <div class="row">
        <?php echo $form->labelEx($category,'parent'); ?>
        <?php echo $form->textField($category,'parent'); ?>
        <?php echo $form->error($category,'parent'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>
    
    <?php $this->endWidget(); ?>
</div>