<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
        //$tabActive = Yii::app()->params['tabAdminActive']['feature'];
        $this->renderPartial('/feature/_form_feature', array('feature'=>$feature)); 
        //$dataProvider=new CActiveDataProvider('Feature');
        $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'grid-feature',
            //'dataProvider'=>$dataProvider,
            'dataProvider'=>$feature->search(),
            'filter'=>$feature,
            'columns'=>array(
                array(
                    'name'=>'id',
                    //'type' => 'raw',
                    'value' => 'CHtml::encode($data->id)'
                ),
                array(
                    'name'=>'name',
                    //'type' => 'raw',
                    'value' => 'CHtml::encode($data->name)'
                ),
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
                            'imageUrl'=> Yii::app()->request->baseUrl.'/assets/1f13eb77/gridview/delete.png', 
                            'url'=>'"javascript:delFeature(\"".$data->id."\",\"".$data->name."\");"',
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
    
    function delFeature(id,name){
        if (confirm('Are you sure you want to delete: "' + name  + '"?')) {
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
    }
    
</script>    
