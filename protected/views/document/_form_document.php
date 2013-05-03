<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$this->pageTitle=Yii::app()->name . ' - Administrator - Document';

?>
<h6>This module only upload jpg, png and pdf files</h6>
<div class="form">
    <?php echo CHtml::form($this->createUrl('uploadDocument'),'post',array('enctype'=>'multipart/form-data')); ?>    
    <?php
    $this->widget('CMultiFileUpload',array(
        'name'=>'files',
        'accept'=>'jpg|png|pdf',
        'max'=>3,
        'remove'=>Yii::t('ui','Remove'),
        //'denied'=>'', message that is displayed when a file type is not allowed
        //'duplicate'=>'', message that is displayed when a file appears twice
        'htmlOptions'=>array('size'=>25),
    ));
    ?>
    <?php echo CHtml::submitButton(Yii::t('ui', 'Upload')); ?>&nbsp;    
    <?php echo CHtml::endForm(); ?>   
</div>