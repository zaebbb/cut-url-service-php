<?php
	include_once './components/header.php'
?>
	<main class="container">
		<div class="row mt-5">
			<div class="col">
				<h1 class="text-center"><span class="badge bg-warning text-dark">Ошибка 404 - Страница не найдена!</span></h1>
				<h2 class="text-center mt-5">Эта ссылка удалена или никогда не существовала</h2>
			</div>
		</div>
	</main>
	<script>
		document.querySelector('title').textContent = "<?php echo SITE_NAME; ?> - Not Found"
	</script>

	<?php include_once './components/footer.php'; ?>