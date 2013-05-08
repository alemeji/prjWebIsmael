<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->renderPartial('/document/_form_document', array('document'=>$document));
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'grid-document',
        'dataProvider'=>$document->search(),
        //'filter'=>$document,
        'columns'=>array(
            array(
                'name'=>'id',
                //'type' => 'raw',
                'value'=>'CHtml::encode($data->id)',
                'filter'=>false
            ),
            array(
                'name'=>'name',
                //'type'=>'raw',
                'value'=>'CHtml::encode($data->name)',
                'filter'=>false
            ),
            array(
                    'name'=>'uri',
                    'type'=>'html',
                    'value'=>'($data->id_type_document == 1)?CHtml::image(Yii::app()->assetManager->publish($data->uri),"",array("style"=>"width:50px;height:50px;")):"no image"',
                    'filter'=>false
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{Delete}',
                'buttons'=> array(
                    //'update'=>array(
                        //'label'=>'modify',
                        //'url'=>'"javascript:modifyFeature(\"".$data->id."\");"',
                    //),
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
