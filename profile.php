<?php 
include_once './components/profile_header.php';

if(!isset($_SESSION['user']['id'])) header("Location: ./index.php");

$links = get_user_links($_SESSION['user']['id']);

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
			<?php 
				if(count($links) !== 0):
			?>
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Ссылка</th>
						<th scope="col">Сокращение</th>
						<th scope="col">Переходы</th>
						<th scope="col">Действия</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($links as $key => $link):
							?>
					<tr>
						<th scope="row"><?=$key+1?></th>
						<td><a href="<?=$link[2]?>" target="_blank"><?=$link[2]?></a></td>
						<td class="short-link"><?=get_url("?url=" . $link[3])?></td>
						<td><?=$link[4]?></td>
						<td>
							<a href="#" class="btn btn-primary btn-sm copy-btn" title="Скопировать в буфер" data-clipboard-text="<?=get_url("?url=" . $link[3])?>"><i class="bi bi-files"></i></a>
							<a href="<?=get_url("components/update.php?id=".$link[0])?>" class="btn btn-warning btn-sm" title="Редактировать"><i class="bi bi-pencil"></i></a>
							<a href="<?=get_url("components/delete.php?id=".$link[0])?>" class="btn btn-danger btn-sm" title="Удалить"><i class="bi bi-trash"></i></a>
						</td>
					</tr>
							<?php
						endforeach;
					?>
				</tbody>
			</table>
			<?php else: ?>
				<h1>Еще ни создана ни одна ссылка</h1>
			<?php endif; ?>
		</div>
	</main>
	<div aria-live="polite" aria-atomic="true" class="position-relative">
		<div class="toast-container position-absolute top-0 start-50 translate-middle-x">
			<div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="d-flex">
					<div class="toast-body">
						Ссылка скопирована в буфер
					</div>
					<button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
			</div>
		</div>
	</div>

	<?php include_once './components/footer.php'; ?>


	<!-- 49.59 -->