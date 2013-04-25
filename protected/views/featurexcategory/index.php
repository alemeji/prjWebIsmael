<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php 
    $this->renderPartial('/featurexcategory/_form_featurexcategory', array('featurexcategory'=>$featurexcategory)); 
    $dataProvider=new CActiveDataProvider('Featurexcategory');
    $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'grid-featurexcategory',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'id_category',
        'id_feature',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{update}{Delete}',
            'buttons'=> array(
                'update'=>array(
                    'label'=>'modify',
                    'url'=>'"javascript:modifyFeaturexCategory(\"".$data->id_feature."\",\"".$data->id_category."\");"',
                ),
                'Delete'=>array(
                    'label'=>'delete',
                    'imageUrl'=> Yii::app()->request->baseUrl.'/assets/1f13eb77/gridview/delete.png', 
                    'url'=>'"javascript:delFeaturexCategory(\"".$data->id_feature."\",\"".$data->id_category."\");"',
                ),
            ),
        ),
    ),
));
?>
<script>
    function modifyFeaturexCategory(id_feature,id_category){
        $.ajax({
            type:'POST',
            url:'<?php echo Yii::app()->createUrl('/Featurexcategory/modify'); ?>',
            data:{'id_feature':id,'id_category':id_category},
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
    
    function delFeaturexCategory(id_feature,id_category){
        
    }
</script>    