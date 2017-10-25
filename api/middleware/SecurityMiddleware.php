<?php

class SecurityMiddleware extends Slim\Middleware {

    public static function checkMe() {
        global $app;
        if (!isset($_SESSION['user']) || $_SESSION['user'] == "") {
            $app->redirect('/api/todo/unauthorized');
        }
        return true;
    }

    public function call() {

        $app = $this->app;

        //The Environment object
        $env = $app->environment();

        //The Request object
        $req = $app->request();

        //The Response object
        $res = $app->response();

        $res['My-header'] = "Middleware Working";

        $this->next->call();
    }

}

?>