<?php
	include_once './components/header.php';

	$success = '';
	$error = '';
	if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
		$error = $_SESSION['error'];
		
		$_SESSION['error'] = '';
	}
	if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
		$success = $_SESSION['success'];
		$_SESSION['success'] = '';
	}

	if(isset($_POST['login']) && !empty($_POST['login'])){
		autorize_user($_POST);
	}

	if(isset($_SESSION['user']['id'])) header("Location: ./profile.php");
?>
	<main class="container">
	<?php
		if(!empty($success)){
			?>
			<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
				<?php echo $success; ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php
		}
	?>
			
	<?php 
		if(!empty($error)){
			?>
			<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
				<?php echo $error; ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php
		}
		?>
		<div class="row mt-5">
			<div class="col">
				<h2 class="text-center">Вход в личный кабинет</h2>
				<p class="text-center">Если вы еще не зарегистрированы, то самое время <a href="<?php echo get_url("login.php")?>">зарегистрироваться</a></p>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-4 offset-4">
				<form method="POST">
					<div class="mb-3">
						<label for="login-input" class="form-label">Логин</label>
						<input type="text" name="login" class="form-control" id="login-input" required>
					</div>
					<div class="mb-3">
						<label for="password-input" class="form-label">Пароль</label>
						<input type="password" name="password" class="form-control" id="password-input" required>
					</div>
					<button type="submit" class="btn btn-primary">Войти</button>
				</form>
			</div>
		</div>
	</main>
	<?php include_once './components/footer.php'; ?>