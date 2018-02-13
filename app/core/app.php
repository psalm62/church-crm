<?php

class App
{
    private $url_controller = null;
    private $url_action = null;
    private $url_params = array();

    public function __construct()
    {
        //получаем параметры из url адреса
        $this->stringUrl();

        if (!$this->url_controller) 
        {
            require_once APP . 'controllers/home.php';
            $page = new Home();
            $page->index();

        }
        elseif (file_exists(APP . 'controllers/' . $this->url_controller . '.php')) 
        {

            require_once APP . 'controllers/' . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();


            if (method_exists($this->url_controller, $this->url_action)) 
            {

                if (!empty($this->url_params)) 
                {
                    call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                } 
                else 
                {
                    $this->url_controller->{$this->url_action}();
                }

            } 
            else 
            {
                if (strlen($this->url_action) == 0) 
                {
                    $this->url_controller->index();
                }
                else 
                {
                    $this->error404();
                }
            }
        } 
        else 
        {
            $this->error404();
        }
    }
    private function stringUrl()
    {
        if (isset($_GET['url'])) 
        {

            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->url_controller = isset($url[0]) ? $url[0] : null;
            $this->url_action = isset($url[1]) ? $url[1] : null;

            unset($url[0], $url[1]);

            $this->url_params = array_values($url);

            // echo 'Controller: ' . $this->url_controller . '<br>';
            // echo 'Action: ' . $this->url_action . '<br>';
            // echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
        }
    }
    public function error404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}
