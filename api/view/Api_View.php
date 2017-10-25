<?php

class Api_View extends Slim\View {

    private $app;
    private $output = array('code' => 200, 'message' => 'Success', 'data' => array());

    public function __construct($app) {
        parent::__construct();
        $this->app = $app;
    }

    public function setResponse($data, $status = 200, $message = 'Success') {
        $this->output['data'] = $data;
        $this->output['code'] = $status;
        // optionally, we could overwritte the http status code
        $this->app->response()->status($status);
        $this->output['message'] = $message;
    }

    public function render($template) {

        //$template = ($template == 'xml') ? 'xml' : 'json';

        $response = $this->app->response();

        switch ($template) {
            case 'json':
                $response['Content-Type'] = 'application/json';
                return $this->jsonRenderer();
            case 'xml':
                $response['Content-Type'] = 'text/xml';
                return $this->xmlRenderer();
            case 'array':
                return $this->arrayRenderer();
        }
    }

    private function xmlRenderer() {
        $xml = Array2XML::createXML('HResponse', $this->output);
        return $xml->saveXML();
    }

    private function arrayRenderer() {
        return array("HResponse" => $this->output);
    }

    private function jsonRenderer() {
        return json_encode(array('HResponse' => $this->output));
    }

}
