<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
        //$tabActive = Yii::app()->params['tabAdminActive']['feature'];
        $this->renderPartial('/feature/_form_feature', array('feature'=>$feature)); 
        $dataProvider=new CActiveDataProvider('Feature');
        $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'grid-feature',
            'dataProvider'=>$dataProvider,
            'columns'=>array(
                'id',          
                'name',
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{update}{Delete}',
                    'buttons'=> array(
                        'update'=>array(
                            'label'=>'modify',
                            'url'=>'"javascript:modifyFeature(\"".$data->id."\");"',
                        ),
                        'Delete'=>array(
                            'label'=>'delete',
                            'url'=>'"javascript:delFeature(\"".$data->id."\");"',
                        ),
                    ),
                ),
            ),
        ));
?>

<script>

    function modifyFeature(id){
        
        $.ajax({
            type:'POST',
            url:'<?php echo Yii::app()->createUrl('/feature/modify'); ?>',
            data:{'id':id},
            dataType: 'json',
            success: function(data){
                 //console.log(data);
                $("#Feature_name").val(data.name);
                $("#Feature_id").val(data.id);
            },
            error: function(data){
                alert("mal");
            }
        });
        
    }
    
    function delFeature(id){
         $.ajax({
            type:'POST',
            url:'<?php echo Yii::app()->createUrl('/feature/delete'); ?>',
            data:{'id':id},
            dataType: 'json',
            success: function(data){
                 //console.log(data);
                 $("#grid-feature").yiiGridView.update('grid-feature');
            },
            error: function(data){
                alert("mal");
            }
        });
        
    }
    
</script>    
