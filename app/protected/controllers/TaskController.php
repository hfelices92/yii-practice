<?php

class TaskController extends Controller
{
    

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

        Yii::app()->apiResponse->send(405, array(
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

        Yii::app()->apiResponse->send(405, array(
            'success' => false,
            'error' => 'Method Not Allowed',
        ));
    }

    protected function viewTask($id)
    {
        $task = $this->loadModel($id);

        if (!$task) {
            Yii::app()->apiResponse->send(404, array(
                'success' => false,
                'error' => 'Task not found.',
            ));
            return;
        }

        Yii::app()->apiResponse->send(200, array(
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

        Yii::app()->apiResponse->send(200, array(
            'success' => true,
            'data' => $taskArray,
        ));
    }

    protected function createTask()
    {
        $data = CJSON::decode(file_get_contents('php://input'), true);

        if (!is_array($data)) {
            Yii::app()->apiResponse->send(400, array(
                'success' => false,
                'error' => 'Invalid JSON payload.',
            ));
            return;
        }

        $task = new Task();
        $task->attributes = $data;

        if ($task->save()) {
            Yii::app()->apiResponse->send(201, array(
                'success' => true,
                'data' => $this->serializeTask($task),
            ));
            return;
        }

        Yii::app()->apiResponse->send(422, array(
            'success' => false,
            'errors' => $task->getErrors(),
        ));
    }


    protected function updateTask($id)
    {
        $task = $this->loadModel($id);

        if (!$task) {
            Yii::app()->apiResponse->send(404, array(
                'success' => false,
                'error' => 'Task not found.',
            ));
            return;
        }

        $data = CJSON::decode(file_get_contents('php://input'), true);

        if (!is_array($data)) {
            Yii::app()->apiResponse->send(400, array(
                'success' => false,
                'error' => 'Invalid JSON payload.',
            ));
            return;
        }

        $task->attributes = $data;

        if ($task->save()) {
            Yii::app()->apiResponse->send(200, array(
                'success' => true,
                'data' => $this->serializeTask($task),
            ));
            return;
        }

        Yii::app()->apiResponse->send(422, array(
            'success' => false,
            'errors' => $task->getErrors(),
        ));
    }


    protected function deleteTask($id)
    {
        $task = $this->loadModel($id);

        if (!$task) {
            Yii::app()->apiResponse->send(404, array(
                'success' => false,
                'error' => 'Task not found.',
            ));
            return;
        }


        if ($task->delete()) {
            Yii::app()->apiResponse->send(200, array(
                'success' => true,
                'message' => 'Task deleted successfully.',
            ));
            return;
        }

        Yii::app()->apiResponse->send(500, array(
            'success' => false,
            'error' => 'Failed to delete the task.',
        ));
    }
}
