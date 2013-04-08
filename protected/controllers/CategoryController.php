<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class CategoryController extends Controller{
    
    public function actionModify(){
        $category = new Category();
        if (isset($_POST['id'])){
             $id = $_POST['id'];
             $category = Category::model()->findByPk($id);
             echo json_encode($category->Attributes);
        }
    }
    
    public function actionDelete(){
        $category = new Category();
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            $category = Category::model()->findByPk($id);
            $category->delete();
        }
    }
}
?>
