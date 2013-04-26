<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
    $Cualquiercosa = "hola mundo";
    //$tabActive = Yii::app()->params['tabAdminActive']['category'];
    $this->renderPartial('/category/_form_category', array('category'=>$category));
    $dataProvider=new CActiveDataProvider('Category');
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'grid-category',
        //'dataProvider'=>$dataProvider,
        'filter'=>$category,
        'dataProvider'=>$category->search(),
        'nullDisplay' => 'Padre',
        'columns'=>array(
            //'id',
            //'parent',
            'name',
            array(
                'name'=>'parent',
                'value'=> '$data->myParent!=null?$data->myParent->name:\'\'',
                'type'=>'text',
            ),            
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
                        'imageUrl'=> Yii::app()->request->baseUrl.'/assets/1f13eb77/gridview/delete.png',
                        'url'=>'"javascript:delCategory(\"".$data->id."\",\"".$data->name."\");"',
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
    
    function delCategory(id,name){
    
    if (confirm('Are you sure you want to delete ' + name  + '?')){
        $.ajax({
            type:'POST',
            url:'<?php echo Yii::app()->createUrl('/category/delete'); ?>',
            data:{'id':id},
            dataType: 'json',
            success: function(data){
                //alert("info data:" + data);
                if (data==0){
                    $("#grid-category").yiiGridView.update('grid-category');
                }else if(data == 1 ){
                    //$('#alert_category').html('Ensayo');
                    //$('#alert_category').show();
                    alert("No puede borrarse");
                }else{
                    //
                }
                
            },
            error: function(data){
                //alert("Esta categoria es padre, borre todos los hijos asociados");
            }
        }); 
    }
    }
    
</script>   
