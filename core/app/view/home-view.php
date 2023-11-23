<?php 


if(!isset($_SESSION['user_id']))
	Core::redir("./");


	$user  = UserData::getByID($_SESSION['user_id']);



?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2> Hola, <?php echo $user->nombre; ?></h2>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		<?php
			Core::getToastr();
		?>

		toastr.success('Hola a todos');

	});
</script>

<?php



?>