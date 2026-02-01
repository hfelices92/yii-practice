<?php

class OrderItemController extends Controller
{
    public function loadModel($id)
    {
        $model = OrderItem::model()->with('product', 'order')->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'Order item not found.');
        }
        return $model;
    }

    public function actionCreate($order_id)
    {
        $model = new OrderItem();
        $model->order_id = $order_id;

        if (isset($_POST['OrderItem'])) {
            $model->attributes = $_POST['OrderItem'];

            // Guardar el precio actual del producto
            $product = Product::model()->findByPk($model->product_id);
            if ($product) {
                $model->unit_price = $product->price;
            }

            if ($model->save()) {
                $this->redirect(array('order/view', 'id' => $order_id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        if (!Yii::app()->request->isPostRequest) {
            throw new CHttpException(400, 'Invalid request.');
        }

        $item = $this->loadModel($id);
        $orderId = $item->order_id;

        $item->delete();

        $this->redirect(array('order/view', 'id' => $orderId));
    }
}
