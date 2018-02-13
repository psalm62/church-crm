<?php

/**
 * summary
 */
class LoginForm extends View
{
	public function all()
	{
?>
		<div class="body-form text-center">
			<form class="form-signin" action="" method="POST">
				<img class="mb-4" src="./img/IMG_6433-min2.png" alt="" width="100" height="100">
				<h1 class="h4 mb-3 font-weight-normal">Войдите или <a href="./reg">регистрация</a></h1>
				<?php if(!empty($this->data)) { extract($this->data); echo "<span style='color:red'>$validate</span><br>";}?>
				<div class="blok-input">
					<label for="inputLogin" class="sr-only">Login</label>
					<input type="text" id="inputLogin" class="form-control" name="login" placeholder="Введите логин" required>
					
					<label for="inputPassword" class="sr-only">Password</label>
					<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Введите пароль" required>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit"><h4 style="margin-bottom: 0">Войти</h4></button>
				<p class="mt-5 mb-3 text-muted">&copy; Psalm62 2018</p>
			</form>
		</div>

<?php
    }

}