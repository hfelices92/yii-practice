<?php

class OrderController extends Controller
{
    public function loadModel($id)
    {
        $model = Order::model()->with('items.product')->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'Order not found.');
        }
        return $model;
    }

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Order', array(
            'criteria' => array(
                'order' => 'created_at DESC',
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Order();

        if (isset($_POST['Order'])) {
            $model->attributes = $_POST['Order'];

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

        if (isset($_POST['Order'])) {
            $model->attributes = $_POST['Order'];

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        if (!Yii::app()->request->isPostRequest) {
            throw new CHttpException(400, 'Invalid request.');
        }

        $this->loadModel($id)->delete();

        $this->redirect(array('index'));
    }
}
