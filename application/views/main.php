<?php require_once 'partials/header.php';?>

<?php if(empty($page)):?>
	<?php require_once 'home.php';?>
<?php elseif($page==='genre'):?>
	<?php require_once 'genre.php';?>
<?php endif;?>

<?php require_once 'partials/footer.php';?>