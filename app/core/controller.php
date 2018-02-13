<?php

class Controller
{

    public $dbh = null;
    public $model = null;

    function __construct()
    {
        $this->openDatabaseConnection();
        $this->loadModel();
    }
    private function openDatabaseConnection()
    {

        //$options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);


        $this->dbh = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }
    public function loadModel()
    {
        require_once APP . 'core/model.php';
        $this->model = new Model($this->dbh);
    }
}
