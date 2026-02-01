<?php

class ApiResponse extends CApplicationComponent
{
    public function send($statusCode, $data = null)
    {
        header('Content-Type: application/json');

        switch ($statusCode) {
            case 200: header('HTTP/1.1 200 OK'); break;
            case 201: header('HTTP/1.1 201 Created'); break;
            case 204: header('HTTP/1.1 204 No Content'); break;
            case 400: header('HTTP/1.1 400 Bad Request'); break;
            case 404: header('HTTP/1.1 404 Not Found'); break;
            case 422: header('HTTP/1.1 422 Unprocessable Entity'); break;
            default:  header('HTTP/1.1 200 OK'); break;
        }

        if ($statusCode !== 204) {
            echo CJSON::encode($data);
        }

        Yii::app()->end();
    }
}
