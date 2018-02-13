<?php

/**
 * summary
 */
class RegForm extends View
{
    public function script()
    {
    	view::script();
    	echo '<script src="./js/addfile.js"></script>';
    }
    public function all()
    {
?>
		<?php if(!empty($this->data)) { extract($this->data); } ?>
		<div class="body-form text-center">
			<form enctype="multipart/form-data" class="form-signin" action="" method="POST">
				<img class="mb-4" src="./img/IMG_6433-min2.png" alt="" width="100" height="100">
				<h1 class="h4 mb-3 font-weight-normal">Регистрация или <a href="./">вход</a></h1>
				<?php if(!empty($this->data)) { extract($this->data); echo "<span style='color:red'>$validate</span><br>"; } ?>
				<div class="blok-input">
					<label for="inputLogin" class="sr-only">Login</label>
					<input type="text" id="inputLogin" class="form-control" name="login" autocomplete="off" value="<?php if(!empty($login)){echo $login;}?>" placeholder="Введите логин" required>
					
					<label for="inputPassword1" class="sr-only">Password</label>
					<input type="password" id="inputPassword1" class="form-control" name="pass[]" autocomplete="off" placeholder="Введите пароль" required>
					
					<label for="inputPassword2" class="sr-only">Password</label>
					<input type="password" id="inputPassword2" class="form-control" name="pass[]" autocomplete="off" placeholder="Повторите пароль" required>
					
					<label for="inputEmail" class="sr-only">Email address</label>
					<input type="email" id="inputEmail" class="form-control" name="email" value="<?php if(!empty($email)){echo $email;}?>" placeholder="Введите email" required>
					<!-- <input type="hidden" name="MAX_FILE_SIZE" value="300000" > -->
					<div class="input-file-row-1">
						<div class="upload-file-container">
							<img id="image" src="#" alt="">						
							<div class="upload-file-container-text">
								<span>Выбрать<br />фото</span>
								<input type="file" name="pic" class="photo" id="imgInput" onchange=readURL(this) accept=".jpg, .jpeg, .png">
							</div>
						</div>
						<div class="font-italic">
							Допустимое расширение для файла .png .jpg .jpeg
							Размер файла не должен превышать 1Мб
						</div>				
					</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit"><h4 style="margin-bottom: 0">Регистрация</h4></button>
				<p class="mt-5 mb-3 text-muted">&copy; Psalm62 2018</p>
			</form>
		</div>
<?php
    }
}
