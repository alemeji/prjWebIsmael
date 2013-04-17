<?php

class FeatureController extends Controller {

    public function actionIndex() {
        $this->render('index');
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
    
    public function actionVerify() {
        if(isset($_POST['name'])){
            $name = $_POST['name'];
            $feature = Feature::model()->findByAttributes(array('name' => $name));
            if($feature){
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

    // Uncomment the following methods and override them if needed
    /*
      public function filters()
      {
      // return the filter configuration for this controller, e.g.:
      return array(
      'inlineFilterName',
      array(
      'class'=>'path.to.FilterClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }

      public function actions()
      {
      // return external action classes, e.g.:
      return array(
      'action1'=>'path.to.ActionClass',
      'action2'=>array(
      'class'=>'path.to.AnotherActionClass',
      'propertyName'=>'propertyValue',
      ),
      );
      }
     */
}