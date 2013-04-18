<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
    //$tabActive = Yii::app()->params['tabAdminActive']['category'];
    $this->renderPartial('/category/_form_category', array('category'=>$category));
    $dataProvider=new CActiveDataProvider('Category');
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'grid-category',
        'dataProvider'=>$dataProvider,
        'columns'=>array(
            'id',
            'parent',
            'name',
            array(
                'class'=>'CButtonColumn',
                'template'=>'{update}{Delete}',
                'buttons'=> array(
                    'update'=>array(
                        'label'=>'modify',
                        'url'=>'"javascript:modifyCategory(\"".$data->id."\");"',
                    ),
                    'Delete'=>array(
                        'label'=>'delete',
                        'url'=>'"javascript:delCategory(\"".$data->id."\");"',
                    ),
                ),
            ),
        ),
    ));
?>
<script>
    
    $(document).ready(function(){
        
        $("#lblParent").hide();
        $("#subcategorys").hide();
        $("#chkParent").click(function(){
            if ($('#chkParent').is(':checked')) {
                $("#subcategorys").show();
            } else {
                $("#subcategorys").hide();
            } 
        });
     });
     
     function modifyCategory(id){
        
        $.ajax({
            type:'POST',
            url:'<?php echo Yii::app()->createUrl('/category/modify'); ?>',
            data:{'id':id},
            dataType: 'json',
            success: function(data){
                $("#Category_name").val(data.name);
                $("#Category_id").val(data.id);
                $("#Category_parent").val(data.parent);
            },
            error: function(data){
                alert("mal");
            }
        });
        
    }
    
    function delCategory(id){
     $.ajax({
        type:'POST',
        url:'<?php echo Yii::app()->createUrl('/category/delete'); ?>',
        data:{'id':id},
        dataType: 'json',
        success: function(data){
             $("#grid-category").yiiGridView.update('grid-category');
        },
        error: function(data){
            //alert("Esta categoria es padre, borre todos los hijos asociados");
        }
    });

    }
    
</script>   
