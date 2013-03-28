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

    public function actionAdmin() {
        $feature = new Feature();
        $category = new Category();

        //Feature
        if (isset($_POST['Feature'])) {
            $this->performAjaxValidation($feature);
            if (empty($_POST['Feature']['id'])) {
                $feature->attributes = $_POST['Feature'];
                if ($feature->save()) {
                    echo "nuevo";
                    $feature->id;
                    $feature->name;
                    $this->render('admin', array('feature' => $feature, 'category' => $category), true);
                }
            } else {
                echo "modif";
                $feature = Feature::model()->findByPk($_POST['Feature']['id']);
                $feature->attributes = $_POST['Feature'];
                if ($feature->save()) {
                    $feature->id = '';
                    $feature->name = '';
                };
            }
        }

        //Category
        if (isset($_POST['Category'])) {
            $this->performAjaxValidation($category);
            $category->attributes = $_POST['Category'];
            //echo $_POST['Category'];
            if ($category->save()) {
                $this->render('admin', array('feature' => $feature, 'category' => $category), true);
            }
        }

        $this->render('admin', array('feature' => $feature, 'category' => $category));
    }

    public function actionModify() {
        $feature = new Feature();
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $feature = Feature::model()->findByPk($id);
            echo json_encode($feature->Attributes);
        }
    }

    public function actionDelete() {
        $feature = new Feature();
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $feature = Feature::model()->findByPk($id);
            $feature->delete();
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
