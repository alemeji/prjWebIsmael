<?php

$bandPanel=0;
if(isset($_GET['bandPanel'])){
    $bandPanel = $_GET['bandPanel'];
    //print_r($bandPanel); die();
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->pageTitle=Yii::app()->name . ' - Administration';
$this->breadcrumbs=array(
	'Administration',
);

?>
<div class="tabbable">
    <ul class="nav nav-tabs">
      <li <?php if($bandPanel == 0){ echo "class=\"active\""; } else{ echo "";} ?> ><a href="#pane1" data-toggle="tab">Features</a></li>
      <li <?php if($bandPanel == 1){ echo "class=\"active\""; } else{ echo "";} ?>><a href="#pane2" data-toggle="tab">Categories</a></li>
    </ul>
    <div class="tab-content"> 
    <div id="pane1" <?php if($bandPanel == 0){ echo "class=\"tab-pane active\""; } else{ echo "class=\"tab-pane inactive\""; } ?>>
      <h4>Features</h4>
      <?php
        $this->renderPartial('_form_feature', array('feature'=>$feature)); 
        $dataProvider=new CActiveDataProvider('Feature');
        $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'grid',
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
    </div> 
    <div id="pane2" <?php if($bandPanel == 1){ echo "class=\"tab-pane active\""; } else{ echo "class=\"tab-pane inactive\""; } ?>>
    <h4>Categories</h4>
    <?php
        $this->renderPartial('_form_category', array('category'=>$category));
        $dataProvider=new CActiveDataProvider('Category');
    ?>
    </div>  
  </div><!-- /.tab-content -->
</div>

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
        /*
        $("#form-feature").submit(function() {
            alert('Handler for .submit() called.');
            //return false;
        });
     */
    });
    
    function modifyFeature(id){
        
        $.ajax({
            type:'POST',
            url:'<?php echo Yii::app()->createUrl('/admin/modify'); ?>',
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
            url:'<?php echo Yii::app()->createUrl('/admin/delete'); ?>',
            data:{'id':id},
            dataType: 'json',
            success: function(data){
                 //console.log(data);
                 $("#grid").yiiGridView.update('grid');
            },
            error: function(data){
                alert("mal");
            }
        });
        
    }
    
</script>
    