<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="form">
     <?php $form = $this->beginWidget('CActiveForm', array(
        'id'=>'form-featurexcategory',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                    'validateOnSubmit'=>true
        ),
        'focus'=>array($featurexcategory,'id_feature')
    )); ?>
    <div class="row">
        <?php echo $form->labelEx($featurexcategory,'id_feature'); ?>
        <?php echo $form->textField($featurexcategory,'id_feature'); ?>
        <?php echo $form->error($featurexcategory,'id_feature'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($featurexcategory,'id_category'); ?>
        <?php echo $form->textField($featurexcategory,'id_category'); ?>
        <?php echo $form->error($featurexcategory,'id_category'); ?>
    </div>

    
    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>
    
    <?php $this->endWidget(); ?>
    
    
    
</div>