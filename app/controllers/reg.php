<?php 

/**
 * summary
 */
class Reg extends Controller
{
	public function index()
	{
		$data['validate']="";

		if(!empty($_POST))
		{
			
 
    		$login=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    		$pass=filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
	    	$email=filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

	    	$size=$_FILES['pic']['size'];
	    	$type=$_FILES['pic']['type'];
	    	$imageinfo=null;
	    	if($size!=0)
	    	{
	    		$imageinfo = getimagesize($_FILES['pic']['tmp_name']);	
	    	}
	    	
	    	if(empty($login))
	    	{
	    		$data['validate']="Логин не может быть пустым";
	    	}
	    	elseif(empty($email))
	    	{
	    		$data['login']=$login;
	    		$data['validate']="Введенный email не является корректным";
	    	}
	    	elseif(empty($_POST['pass']) || 
	    			!is_array($_POST['pass']) || 
	    			count($_POST['pass'])!=2 || 
	    			$_POST['pass'][0]!==$_POST['pass'][1])
	    	{
	    		$data['login']=$login;
	    		$data['email']=$email;
	    		$data['validate']="Проверьте правильность ввода пароля";
	    	}
    		elseif($size>1000000)
    		{
    			$data['login']=$login;
    			$data['email']=$email;
    			$data['validate']="Загруженный файл превышает допустимый размер";
    		}
    		elseif(($imageinfo!=null && $type!="image/png" && $type!="image/jpeg") || $imageinfo===false)
    		{
    			$data['login']=$login;
    			$data['email']=$email;
    			$data['validate']="Загруженный файл недопустимого типаa";
    		}
			elseif(($imageinfo!=null && $imageinfo['mime'] != 'image/png' && $imageinfo['mime'] != 'image/jpeg') || $imageinfo===false) 
			{
				$data['login']=$login;
				$data['email']=$email;
				$data['validate']="Загруженный файл недопустимого типа";
			}
    		else 
	    	{
	    		$ivSize=openssl_cipher_iv_length(DBA);
	    		$iv=openssl_random_pseudo_bytes($ivSize);
	    		$filename="none";
	    		if($size!=0)
	    		{
	    			$add_name = bin2hex(random_bytes(12));
	    			$uploaddir = './uploads/';
					if($imageinfo['mime']=='image/png')
					{
						$exp = '.png';
					}
					if($imageinfo['mime']=='image/jpeg')
					{
						$exp = '.jpg';
					}
					if(file_exists($uploaddir . $add_name . $exp))
					{
						$add_name = bin2hex(random_bytes(14));
					}
					$uploadfile = $uploaddir . $add_name . $exp;

					if (move_uploaded_file($_FILES['pic']['tmp_name'], $uploadfile)) 
					{
					    $filename=$uploadfile;//$add_name . basename($_FILES['pic']['name']);
					    $filename=openssl_encrypt($filename, DBA, GLOBAL_KEY, OPENSSL_RAW_DATA, $iv);
					} 
					else 
					{
					    echo "Возможная атака с помощью файловой загрузки!\n";
					    //die();
					}
	    		}

	    		$c_login=openssl_encrypt($login, DBA, GLOBAL_KEY, OPENSSL_RAW_DATA, GLOBAL_IV);
	    		$c_email=openssl_encrypt($email, DBA, GLOBAL_KEY, OPENSSL_RAW_DATA, $iv);
	    		$c_pass=password_hash($pass[0], PASSWORD_BCRYPT, ["cost" => 12]);
	    		$res=$this->model->add_User($c_login, $c_email, $c_pass, $iv, $filename);
	    		if($res)
	    		{
					// $sendiv=base64_encode($iv);
					// header("Location: http://toor.space/createkey.php?key={$sendiv}");
	    			
	    			header('Location: '. URL . '/');
	    			die();
	    		}
	    		else
	    		{
	    			$data['validate']="Не удалось. Возможно, что такой логин уже занят.";
	    		}
	    	}
		}
		require_once APP . 'views/regform.php';
        $view = new RegForm();
        $view -> content($data);	
	}
}