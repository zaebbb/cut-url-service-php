<?php 
	include_once './components/header.php';
	
	if(isset($_GET['url']) && !empty($_GET['url'])){
		$link = get_view_link();

		if(empty($link)){
			header('Location: 404.php');
			die;
		}

		header("Location: " . $link['long_link']);
		die;
	}
?>
	<main class="container">
		<?php 
			if(!isset($_SESSION['user']['id'])):
		?>
		<div class="row mt-5">
			<div class="col">
				<h2 class="text-center">Необходимо <a href="<?php echo get_url('register.php'); ?>">зарегистрироваться</a> или <a href="<?php echo get_url('login.php'); ?>">войти</a> под своей учетной записью</h2>
			</div>
		</div>
		<? endif; ?>
		<div class="row mt-5">
			<div class="col">
				<h2 class="text-center">Пользователей в системе: <?php echo get_count_user()['allUsers']; ?></h2>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col">
				<h2 class="text-center">Ссылок в системе: <?php echo get_count_links()['allLinks']; ?></h2>
			</div>
		</div>
		<div class="row mt-5">
			<div class="col">
				<h2 class="text-center">Всего переходов по ссылкам: <?php echo get_sum_link()['sumViews']; ?></h2>
			</div>
		</div>
	</main>
<?php include_once './components/footer.php'; ?>