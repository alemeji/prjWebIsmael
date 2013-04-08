<?php

if (isset($_GET['tabActive'])){
    $tabActive = $_GET['tabActive'];
}else{
    $tabActive = Yii::app()->params['tabAdminActive']['feature'];
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

<?php
    echo "valor de tabActive[".$tabActive."]";
$this->widget('CTabView',array(
    'activeTab'=>$tabActive,
    'tabs'=>array(
        'tab1'=>array(
            'title'=>'Feature',
            'view'=>'/feature/index',
            'data'=>array('feature'=>$feature),
        ),
        'tab2'=>array(
            'title'=>'Category',
            'view'=>'/category/index',
            'data'=>array('category'=>$category),
        ),        
        /*'tab3'=>array('title'=>'Url tab','url'=>Yii::app()->createUrl("site/index"),)*/
    ),
    /*'htmlOptions'=>array(
        'style'=>'width:500px;'
    )*/
));
?>

    