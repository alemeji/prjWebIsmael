<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
    $tabActive = Yii::app()->params['tabAdminActive']['category'];
    $this->renderPartial('/category/_form_category', array('category'=>$category));
    $dataProvider=new CActiveDataProvider('Category');
    /*$this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'grid',
        'dataProvider'=>$dataProvider,
        'columns'=>array(
            'id',          
            'name',
            'parent',
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
    ));*/
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
    
</script>   
