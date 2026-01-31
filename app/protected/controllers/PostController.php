<?php

class PostController extends Controller
{

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Post', array(
            'pagination' => array(
                'pageSize' => 10,
            ),
            'sort' => array(
                'defaultOrder' => 'created_at DESC',
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Post;

        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }


    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Post'])) {
            $model->attributes = $_POST['Post'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }
    
    /** 
    * actionDelete without filters for simplicity
    * public function actionDelete($id)
    * {
    *     if (Yii::app()->request->isPostRequest) {
    *         // we only allow deletion via POST request
    *         $this->loadModel($id)->delete();

    *         // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
    *         if (!isset($_GET['ajax'])) {
    *             $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
    *         }
    *     } else {
    *         throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    *     }
    * }
    */


    // actionDelete with filters
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        $this->redirect(array('index'));
    }


    public function filters()
    {
        return array(
            'postOnly + delete',
        );
    }



    /**
     * Loads the model based on the primary key given in the GET variable.
     * @param integer $id the ID of the model to be loaded
     * @return Post the loaded model
     * @throws CHttpException
     */
    protected function loadModel($id)
    {
        $model = Post::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
}
