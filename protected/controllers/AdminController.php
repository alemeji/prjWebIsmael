<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adminController
 *
 * @author alemeji
 */
class AdminController extends Controller {
    
    public function actionIndex() {
        $feature = new Feature();
        $category = new Category();
        
         //Feature
        if (isset($_POST['Feature'])){
             $this->feature($feature);
        }
      
        //Category
        if (isset($_POST['Category'])) {
            $this->category($category);
        }

        $this->render('index', array('feature' => $feature, 'category' => $category));
    }
    
    private function feature($feature){
        //Feature
        $tabActive = Yii::app()->params['tabAdminActive']['feature'];
        $this->performAjaxValidation($feature);
        if (empty($_POST['Feature']['id'])) {
            $feature->attributes = $_POST['Feature'];
            if ($feature->save()) {
                $this->redirect(array('index', 'tabActive'=>$tabActive));
            }
        } else {
            echo "modif";
            $feature = Feature::model()->findByPk($_POST['Feature']['id']);
            $feature->attributes = $_POST['Feature'];
            if ($feature->save()) {
                $this->redirect(array('index', 'tabActive'=>$tabActive));
            };
        }
    } 
    
    private function category($category){
        //Category
        $tabActive = Yii::app()->params['tabAdminActive']['category'];
        $this->performAjaxValidation($category);
        $category->attributes = $_POST['Category'];
        //echo $_POST['Category'];
        if ($category->save()) {
            $this->redirect(array('index','tabActive'=>$tabActive));
        }        
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'form-' . $model->tableName()) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}

?>
