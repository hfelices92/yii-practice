<?php

class TaskController extends Controller
{
    protected function sendResponse($statusCode, $data)
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
            case 403:
                header('HTTP/1.1 403 Forbidden');
                break;
            case 404:
                header('HTTP/1.1 404 Not Found');
                break;
            case 422:
                header('HTTP/1.1 422 Unprocessable Entity');
                break;
            case 500:
                header('HTTP/1.1 500 Internal Server Error');
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

    protected function serializeTask(Task $task)
    {
        return array(
            'id' => (int) $task->id,
            'title' => $task->title,
            'description' => $task->description !== null ? $task->description : null,
            'due_date' => $task->due_date,
            'status' => $task->status,
            'created_at' => $task->created_at,
        );
    }

    protected function loadModel($id)
    {
        $model = Task::model()->findByPk($id);
        return $model;
    }

    public function actionIndex()
    {
        $method = Yii::app()->request->requestType;

        if ($method === 'GET') {
            $this->listTasks();
            return;
        }

        if ($method === 'POST') {
            $this->createTask();
            return;
        }

        $this->sendResponse(405, array(
            'success' => false,
            'error' => 'Method Not Allowed',
        ));
    }

    public function actionView($id)
    {
        $method = Yii::app()->request->requestType;

        if ($method === 'GET') {
            $this->viewTask($id);
            return;
        }

        if ($method === 'PUT') {
            $this->updateTask($id);
            return;
        }

        if ($method === 'DELETE') {
            $this->deleteTask($id);
            return;
        }

        $this->sendResponse(405, array(
            'success' => false,
            'error' => 'Method Not Allowed',
        ));
    }

    protected function viewTask($id)
    {
        $task = $this->loadModel($id);

        if (!$task) {
            $this->sendResponse(404, array(
                'success' => false,
                'error' => 'Task not found.',
            ));
            return;
        }

        $this->sendResponse(200, array(
            'success' => true,
            'data' => $this->serializeTask($task),
        ));
    }
    protected function listTasks()
    {
        $tasks = Task::model()->findAll(array(
            'order' => 'created_at DESC',
        ));

        $taskArray = array();

        foreach ($tasks as $task) {
            $taskArray[] = $this->serializeTask($task);
        }

        $this->sendResponse(200, array(
            'success' => true,
            'data' => $taskArray,
        ));
    }

    protected function createTask()
    {
        $data = CJSON::decode(file_get_contents('php://input'), true);

        if (!is_array($data)) {
            $this->sendResponse(400, array(
                'success' => false,
                'error' => 'Invalid JSON payload.',
            ));
            return;
        }

        $task = new Task();
        $task->attributes = $data;

        if ($task->save()) {
            $this->sendResponse(201, array(
                'success' => true,
                'data' => $this->serializeTask($task),
            ));
            return;
        }

        $this->sendResponse(422, array(
            'success' => false,
            'errors' => $task->getErrors(),
        ));
    }


    protected function updateTask($id)
    {
        $task = $this->loadModel($id);

        if (!$task) {
            $this->sendResponse(404, array(
                'success' => false,
                'error' => 'Task not found.',
            ));
            return;
        }

        $data = CJSON::decode(file_get_contents('php://input'), true);

        if (!is_array($data)) {
            $this->sendResponse(400, array(
                'success' => false,
                'error' => 'Invalid JSON payload.',
            ));
            return;
        }

        $task->attributes = $data;

        if ($task->save()) {
            $this->sendResponse(200, array(
                'success' => true,
                'data' => $this->serializeTask($task),
            ));
            return;
        }

        $this->sendResponse(422, array(
            'success' => false,
            'errors' => $task->getErrors(),
        ));
    }


    protected function deleteTask($id)
    {
        $task = $this->loadModel($id);

        if (!$task) {
            $this->sendResponse(404, array(
                'success' => false,
                'error' => 'Task not found.',
            ));
            return;
        }


        if ($task->delete()) {
            $this->sendResponse(200, array(
                'success' => true,
                'message' => 'Task deleted successfully.',
            ));
            return;
        }

        $this->sendResponse(500, array(
            'success' => false,
            'error' => 'Failed to delete the task.',
        ));
    }
}
