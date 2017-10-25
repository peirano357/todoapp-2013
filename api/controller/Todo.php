<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of todo
 *
 * @author Web01
 */
include_once($_SERVER['DOCUMENT_ROOT'] . "/config_todo.php");
require '../lib/mygen_framework.php';
require '../lib/mygen_mysql.php';
require '../lib/DBConn.php';
require '../classes/event.class.php';

class Todo extends Controller {

    //put your code here

    public function __construct() {
        $this->className = 'todo';
        parent::__construct();
    }

    public function index() {
        $this->app->get("/" . $this->className . '/list', array("SecurityMiddleware", "checkMe"), array($this, 'getList'));
        $this->app->delete("/" . $this->className . '/delete', array("SecurityMiddleware", "checkMe"), array($this, "deleteEvent"));
        $this->app->post("/" . $this->className . '/changestatus', array("SecurityMiddleware", "checkMe"), array($this, "changeStatus"));
        $this->app->post("/" . $this->className . '/changepriority', array("SecurityMiddleware", "checkMe"), array($this, "changePriority"));
        $this->app->put("/" . $this->className . '/add', array("SecurityMiddleware", "checkMe"), array($this, "addEvent"));

        $this->app->post("/" . $this->className . '/updatetitle', array("SecurityMiddleware", "checkMe"), array($this, "updateTitle"));
        $this->app->post("/" . $this->className . '/updatedate', array("SecurityMiddleware", "checkMe"), array($this, "updateDate"));
        $this->app->get("/" . $this->className . '/loginApp', array($this, "loginApp"));
        $this->app->get("/" . $this->className . '/logoutApp', array($this, "logoutApp"));
        $this->app->get("/" . $this->className . '/unauthorized', array($this, "unauthorized"));
    }

    public function getList($format = "json") {

        // CALL TO FUNCTION IN CLASS EVENT
        $message = "Error";

        $field = $this->app->request()->get("field");
        $way = $this->app->request()->get("way");

        if (is_numeric($way) && ($field == 'title' || $field == 'priority' || $field == 'date')) {
            $result = eventCollection::showList($field, $way);
            $message = "Success";
        }

        $this->data = $result;
        $this->app->view()->setResponse($this->data, 200, $message);
        $this->app->render($format);
    }

    public function deleteEvent($format = "json") {

        // CALL TO FUNCTION IN CLASS EVENT
        $message = "Error";
        $this->data = '';

        $event = $this->app->request()->delete("event");
        if (is_numeric($event)) {

            $result = event::deleteEvent($event);

            if ($result == true) {
                $message = "Success";
                $this->data = $event;
            }
        }

        $this->app->view()->setResponse($this->data, 200, $message);
        $this->app->render($format);
    }

    public function changeStatus($format = "json") {

        // CALL TO FUNCTION IN CLASS EVENT
        $message = "Error";
        $this->data = '';

        $event = $this->app->request()->post("event");
        $actualStatus = $this->app->request()->post("status");

        if (is_numeric($event) && is_numeric($actualStatus)) {

            $result = event::changeStatus($event, $actualStatus);

            if ($result == true) {
                $message = "Success";
                $this->data = $actualStatus;
            }
        }

        $this->app->view()->setResponse($this->data, 200, $message);
        $this->app->render($format);
    }

    public function changePriority($format = "json") {

        // CALL TO FUNCTION IN CLASS EVENT
        $message = "Error";
        $this->data = '';

        $event = $this->app->request()->post("event");
        $actualStatus = $this->app->request()->post("priority");

        if (is_numeric($event) && is_numeric($actualStatus)) {

            $result = event::changePriority($event, $actualStatus);
            if ($result == true) {
                $message = "Success";
                $this->data = $actualStatus;
                ;
            }
        }

        $this->app->view()->setResponse($this->data, 200, $message);
        $this->app->render($format);
    }

    public function addEvent($format = "json") {

        // CALL TO FUNCTION IN CLASS EVENT
        $message = "Error";
        $this->data = '';

        $arrayParams['TITLE'] = $this->app->request()->put("title");
        $arrayParams['DATE'] = $this->app->request()->put("date");
        $arrayParams['PRIORITY'] = $this->app->request()->put("priority");


        $id = event::add($arrayParams);

        if ($id != 0) {
            $message = "Success";
            $this->data = $id;
        }

        $this->app->view()->setResponse($this->data, 200, $message);
        $this->app->render($format);
    }

    public function updateTitle($format = "json") {

        // CALL TO FUNCTION IN CLASS EVENT
        $message = "Error";
        $this->data = '';

        $event = $this->app->request()->post("event");
        $newTitle = $this->app->request()->post("title");

        if (is_numeric($event)) {

            $result = event::changeTitle($event, $newTitle);

            if ($result == true) {
                $message = "Success";
                $this->data = $newTitle;
            }
        }

        $this->app->view()->setResponse($this->data, 200, $message);
        $this->app->render($format);
    }

    public function updateDate($format = "json") {

        // CALL TO FUNCTION IN CLASS EVENT
        $message = "Error";
        $this->data = '';

        $event = $this->app->request()->post("event");
        $newDate = $this->app->request()->post("date");

        if (is_numeric($event)) {

            $result = event::changeDate($event, $newDate);

            if ($result == true) {
                $message = "Success";
                $this->data = $newDate;
            }
        }

        $this->app->view()->setResponse($this->data, 200, $message);
        $this->app->render($format);
    }

    public function loginApp() {

        $email = $this->app->request()->get('email');
        $password = $this->app->request()->get('password');

        if ($email == "josue@webstreaming.com.ar" && $password == "josuepass") {

            $_SESSION['user'] = $email;
            $this->app->view()->setResponse(array(), 200, 'login success');
            $this->app->render('json');
        } else {
            $app->redirect('/api/todo/unauthorized');
        }
    }

    public function unauthorized() {

        $this->app->view()->setResponse(array(), 500, 'unauthorized');
        $this->app->render('json');
    }

    public function logoutApp() {
        unset($_SESSION['user']);
        $this->app->view()->setResponse(array(), 200, 'logout success');
        $this->app->render('json');
    }

}

?>
