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
    
    <div class="row">
        <?php echo CHtml::link('New', array('/admin/index')); ?>
    </div>
    <div class="alert" id="alert_category">
        <strong>Warning!</strong> La categoria ya existe.
    </div>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    
    <?php echo $form->errorSummary($category); ?>
    
    <div class="row">
        <?php //echo $form->labelEx($category,'id'); ?>
        <?php echo $form->hiddenField($category,'id'); ?>
        <?php echo $form->error($category,'id'); ?>
    </div>
    
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
                      array('empty' => '(Select parent category)',
                            'onChange' => 'javascript:changeCategoryParent(this.value);',
                          ));
        ?>
    </div>
   
    <div class="row">
        <?php //echo $form->labelEx($category,'parent'); ?>
        <?php echo $form->hiddenField($category,'parent'/*,array('disabled'=>true)*/); ?>
        <?php echo $form->error($category,'parent'); ?> 
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>
    
    <?php $this->endWidget(); ?>
</div>

<script>
    var result = 3;
    $("#alert_category").hide();
    
    function changeCategoryParent(value){
        document.getElementById("Category_parent").value = value;
    }
    
    $("#form-category").submit(function(){
        if(result == 1){
            return false;
        }
    })
    
    $("#Category_name").blur(function(){
       name = $("#Category_name").val();
       
       $.ajax({
           type:'POST',
           url:'<?php echo Yii::app()->createUrl('/category/verify'); ?>',
           data:{'name':name},
           dataType: 'json',
           success: function(data){
               //console.log(data);
               result = data;
               if(result == 1){
                   $("#alert_category").show();
               }else{
                   $("#alert_category").hide();
               }
               //alert(result);
           },
           error: function(data){
               //alert('error');
           }
       });
       
    });  
</script>    