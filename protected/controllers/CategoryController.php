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
    
    public function actionVerify(){
        if (isset($_POST['name'])){
            $name = $_POST['name'];
            $category = Category::model()->findByAttributes(array('name' => $name));
            if($category){
                //echo "existe";
                //$result['result'] = 1;
                $result = 1;
            }else{  
                //echo "no existe";
                //$result['result'] = 0;
                $result = 0;
            }
            echo json_encode($result);
        }
    }
    
}
?>
