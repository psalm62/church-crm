<?php

class Home extends Controller
{

    public $data=null;

    public function index()
    {
        
        session_start();

        if(empty($_SESSION))
        {
            if(!empty($_POST))
            {
                $login=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
                $pass=filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

                $c_login=openssl_encrypt($login, DBA, GLOBAL_KEY, OPENSSL_RAW_DATA, GLOBAL_IV);
                
                $res = $this->model->testLogin($c_login, $pass);

                if($res)
                {
                    $_SESSION['id']=$res['id'];
                    $_SESSION['iv']=$res['iv'];
                    header('Location: ./');
                    die();
                }
                else
                {
                    $this->data['validate']="Не верный логин или пароль.";
                }
            }
            require_once APP . 'views/loginform.php';
            $view = new LoginForm();
            $view -> content($this->data);    
            
        }
        else
        {
            require_once APP . 'views/userpage.php';
            $view = new UserPage();
            $dat = $this->model->getAllSum('1');
            $view -> content($dat); 
        }
        
    }
}
