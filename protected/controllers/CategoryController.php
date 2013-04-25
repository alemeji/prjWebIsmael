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
        $result = 0;
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            if ($this->noRecordsFeaturexcategory($id) == 0 ){
                $category = Category::model()->findByPk($id);
                //Es padre?
                if ($category->parent == NULL){
                    //Es papa de otros?
                  $childrens = Category::model()->find('parent=:id',array(':id'=>$id));
                  if (count($childrens) == 0){
                      $category->delete();
                      $result = 0;
                  }             
                }else{
                    //Tengo hijos
                     $childrens = Category::model()->find('parent=:id',array(':id'=>$id));
                  if (count($childrens) > 0){
                       //No borrar
                       $result = 1;
                  } else{
                       $category->delete();
                       $result = 0;
                  }
                }             
            }else{
                //No se puede borrar
                //echo "No se puede borrar";
                $result = 1;
            }
         }
         echo json_encode($result);
    }
    
    private function noRecordsFeaturexcategory($id){
        //Buscar registros existentes en Featurexcategory
        $fxc = Featurexcategory::model()->find('id_category=:id',array(':id'=>$id));
        return count($fxc);
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
