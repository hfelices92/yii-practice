<?php

class ProductController extends Controller
{
    /* =========================
     *  HELPERS API
     * ========================= */

    protected function sendResponse($statusCode, $data = null)
    {
        header('Content-Type: application/json');

        switch ($statusCode) {
            case 200:
                header('HTTP/1.1 200 OK');
                break;
            case 201:
                header('HTTP/1.1 201 Created');
                break;
            case 204:
                header('HTTP/1.1 204 No Content');
                break;
            case 400:
                header('HTTP/1.1 400 Bad Request');
                break;
            case 404:
                header('HTTP/1.1 404 Not Found');
                break;
            case 422:
                header('HTTP/1.1 422 Unprocessable Entity');
                break;
            default:
                header('HTTP/1.1 200 OK');
                break;
        }

        if ($statusCode !== 204) {
            echo CJSON::encode($data);
        }

        Yii::app()->end();
    }

    protected function serializeProduct(Product $product)
    {
        return array(
            'id' => (int) $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => (float) $product->price,
            'stock' => (int) $product->stock,
            'status' => $product->status,
            'created_at' => $product->created_at,
        );
    }

    protected function loadModel($id)
    {
        return Product::model()->findByPk($id);
    }

    /* =========================
     *  DISPATCHERS
     * ========================= */

    /**
     * /product
     * GET  -> vistas (index) o API list
     * POST -> API create
     */
    public function actionIndex()
    {
        if (Yii::app()->request->isAjaxRequest || Yii::app()->request->getAcceptTypes() === 'application/json') {
            // API
            if (Yii::app()->request->requestType === 'GET') {
                $this->listProductsApi();
                return;
            }

            if (Yii::app()->request->requestType === 'POST') {
                $this->createProductApi();
                return;
            }

            $this->sendResponse(405, ['success' => false, 'error' => 'Method Not Allowed']);
        }

        // VISTA HTML
        $dataProvider = new CActiveDataProvider('Product', [
            'criteria' => [
                'order' => 'created_at DESC',
            ],
        ]);

        $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * /product/{id}
     * GET    -> vista view / API view
     * PUT    -> API update
     * DELETE -> API delete
     */
    public function actionView($id)
    {
        $product = $this->loadModel($id);

        if (!$product) {
            throw new CHttpException(404, 'Product not found.');
        }

        if (Yii::app()->request->isAjaxRequest || Yii::app()->request->getAcceptTypes() === 'application/json') {
            $method = Yii::app()->request->requestType;

            if ($method === 'GET') {
                $this->sendResponse(200, [
                    'success' => true,
                    'data' => $this->serializeProduct($product),
                ]);
            }

            if ($method === 'PUT') {
                $this->updateProductApi($product);
            }

            if ($method === 'DELETE') {
                $this->deleteProductApi($product);
            }

            $this->sendResponse(405, ['success' => false, 'error' => 'Method Not Allowed']);
        }

        // VISTA HTML
        $this->render('view', [
            'model' => $product,
        ]);
    }

    /* =========================
     *  API METHODS
     * ========================= */

    protected function listProductsApi()
    {
        $products = Product::model()->findAllByAttributes(
            ['status' => 'active'],
            ['order' => 'created_at DESC']
        );

        $data = [];
        foreach ($products as $product) {
            $data[] = $this->serializeProduct($product);
        }

        $this->sendResponse(200, [
            'success' => true,
            'data' => $data,
        ]);
    }

    protected function createProductApi()
    {
        $data = CJSON::decode(file_get_contents('php://input'), true);

        if (!is_array($data)) {
            $this->sendResponse(400, ['success' => false, 'error' => 'Invalid JSON payload']);
        }

        $product = new Product();
        $product->attributes = $data;

        if ($product->save()) {
            $this->sendResponse(201, [
                'success' => true,
                'data' => $this->serializeProduct($product),
            ]);
        }

        $this->sendResponse(422, [
            'success' => false,
            'errors' => $product->getErrors(),
        ]);
    }

    protected function updateProductApi(Product $product)
    {
        $data = CJSON::decode(file_get_contents('php://input'), true);

        if (!is_array($data)) {
            $this->sendResponse(400, ['success' => false, 'error' => 'Invalid JSON payload']);
        }

        $product->attributes = $data;

        if ($product->save()) {
            $this->sendResponse(200, [
                'success' => true,
                'data' => $this->serializeProduct($product),
            ]);
        }

        $this->sendResponse(422, [
            'success' => false,
            'errors' => $product->getErrors(),
        ]);
    }

    protected function deleteProductApi(Product $product)
    {
        $product->delete();

        $this->sendResponse(200, [
            'success' => true,
            'message' => 'Product deleted successfully.',
        ]);
    }

    /* =========================
     *  VISTAS HTML
     * ========================= */

    public function actionCreate()
    {
        $model = new Product();

        if (isset($_POST['Product'])) {
            $model->attributes = $_POST['Product'];
            if ($model->save()) {
                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (!$model) {
            throw new CHttpException(404, 'Product not found.');
        }

        if (isset($_POST['Product'])) {
            $model->attributes = $_POST['Product'];
            if ($model->save()) {
                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('update', [
            'model' => $model,
        ]);
    }
}
