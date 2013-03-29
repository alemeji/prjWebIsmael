<?php

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
      <li class="active"><a href="#pane1" data-toggle="tab">Features</a></li>
      <li><a href="#pane2" data-toggle="tab">Categories</a></li>
      <li><a href="#pane3" data-toggle="tab">Feature x Category</a></li>
      <li><a href="#pane4" data-toggle="tab">Items</a></li>
    </ul>
    <div class="tab-content"> 
    <div id="pane1" class="tab-pane active">
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
    <div id="pane2" class="tab-pane">
    <h4>Categories</h4>
    <?php
        $this->renderPartial('_form_category', array('category'=>$category));
        $dataProvider=new CActiveDataProvider('Category');
    ?>
    </div>    
     <div id="pane3" class="tab-pane">
      <h4>Feature x Category</h4>
      <p>...</p>
    </div>           
    <div id="pane4" class="tab-pane">
      <h4>Items</h4>
      <p>...</p>
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
    