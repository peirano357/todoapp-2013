<?php

class Controller {

    protected $app;
    protected $className = '';
    protected $response = null;

    public function __construct($app = null) {
        $this->app = ($app instanceof Slim) ? $app : Slim\Slim::getInstance();
        $this->response = $this->app->response();
        $this->response['Access-Control-Allow-Origin'] = "*";
        $this->response['Content-Type'] = 'application/json';
        $this->response['X-Powered-By'] = 'WEBSTREAMING';
        $this->index();
    }

    public function halt($code = 403, $message = "Error", $data = "") {
        $arrJson = array("HResponse" => array(
                "code" => $code,
                "message" => $message,
                "data" => $data
                ));
        $this->app->halt($code, json_encode($arrJson));
    }

}