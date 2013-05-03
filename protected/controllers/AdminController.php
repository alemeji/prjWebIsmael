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
    
    public function actionIndex(){
        $feature = new Feature();
        $category = new Category();
        $featurexcategory = new Featurexcategory();
        $document = new Document();
        
        $feature->unsetAttributes();
        
        if(isset($_GET['Feature'])){
            $feature->attributes=$_GET['Feature'];
        }
        
         //Feature
        if(isset($_POST['Feature'])){
            $this->feature($feature);
        }
        
        if(isset($_GET['Category'])){
            $category->attributes=$_GET['Category'];
        }        
      
        //Category
        if(isset($_POST['Category'])){
            $this->category($category);
        }
        
        //Featurexcategory
        if(isset($_POST['Featurexcategory'])){
            $this->featurexcategory($featurexcategory);
        }
        
        /*if(isset($_POST['Document'])){
            $this->document($document);
        }*/

        $this->render('index', array('feature'=>$feature, 'category'=>$category,'featurexcategory'=>$featurexcategory,'document' =>$document));
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
            echo "modif feature";
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
        if (empty($_POST['Category']['id'])){
            $category->attributes = $_POST['Category'];
            if($category->save()){
                $this->redirect(array('index', 'tabActive'=>$tabActive));
            }
        }else{
            echo "modif category";
            $category = Category::model()->findByPk($_POST['Category']['id']);
            $category->attributes = $_POST['Category'];
            if($category->save()){
                $this->redirect(array('index', 'tabActive'=>$tabActive));
            }            
        }
        $category->attributes = $_POST['Category'];
        //echo $_POST['Category'];
        if ($category->save()) {
            $this->redirect(array('index','tabActive'=>$tabActive));
        }        
    }

    protected function performAjaxValidation($model){
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'form-' . $model->tableName()) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function featurexcategory($featurexcategory){
         $tabActive = Yii::app()->params['tabAdminActive']['featurexcategory'];
         $this->performAjaxValidation($featurexcategory);
         $featurexcategory->attributes = $_POST['Featurexcategory'];
         if ($featurexcategory->save()){
             $this->redirect(array('index', 'tabActive'=>$tabActive));
         }
    }
    
    	public function actionUploadDocument(){
                $tabActive = Yii::app()->params['tabAdminActive']['document'];
		if(isset($_FILES['files']))
		{
			// delete old files
			/*foreach($this->findFiles() as $filename)
				unlink(Yii::app()->params['uploadDir'].$filename);*/
                                
			//upload new files
			foreach($_FILES['files']['name'] as $key=>$filename){
                                $document = new Document();
                                $document->name = $filename;
                                $type_document = strstr($filename,'.');
                                if($type_document == ".jpg"){
                                    $document->uri = Yii::app()->params['uploadImg'].$filename;
                                    $document->id_type_document = 1;
                                }elseif($type_document == ".png"){
                                    $document->uri = Yii::app()->params['uploadImg'].$filename;
                                    $document->id_type_document = 2;
                                }
                                elseif($type_document == ".pdf"){
                                    $document->uri = Yii::app()->params['uploadDoc'].$filename;
                                    $document->id_type_document = 3;
                                }
                                else{
                                    echo error;
                                }
                                if($document->save()){
                                    if($type_document == ".jpg" || $type_document == ".png"){
                                        move_uploaded_file($_FILES['files']['tmp_name'][$key],Yii::app()->params['uploadImg'].$filename);
                                    }elseif($type_document == ".pdf"){
                                        move_uploaded_file($_FILES['files']['tmp_name'][$key],Yii::app()->params['uploadDoc'].$filename);
                                    }
                                }else{
                                    echo "no save";
                                }
                        }
		}
		$this->redirect(array('index','tabActive'=>$tabActive));
	}
        
	public function findFiles(){
		return array_diff(scandir(Yii::app()->params['uploadImg']), array('.', '..'));
	}

}

?>
