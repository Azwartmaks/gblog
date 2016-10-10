<!DOCTYPE html>
<html>
<head>
	<title>Admin area</title>
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body class="body bg-grey">
	<div class="container wrap bg-white">
	<?php 
		if(!empty($is_login))
		{
			include 'header.php';
		}
	?>
	<?php 
		if(empty($is_login))
		{
			$formExtra = array(
					'class'=>'login-form'
				);
			$loginInputExtra = array (
					'placeholder'=>'Login',
					'class'=>'form-control'
				);
			$passwordInputExtra = array (
					'placeholder'=>'Password',
					'class'=>'form-control'
				);
			$submitBtnExtra = array(
					'class' => 'btn btn-default'
				);
			
			echo form_open(base_url() . 'admin/validate',$formExtra);
			echo form_input('login','',$loginInputExtra);
			echo "<br>";
			echo form_password('password','',$passwordInputExtra);
			echo "<br>";
			echo form_submit('login_submit','Sign In', $submitBtnExtra);
		}
		else if(!empty($partial) && $partial == 'add_article')
		{
			include 'add_article.php';
		}
		else if(!empty($partial) && $partial == 'add_category')
		{
			include 'add_category.php';
		}
		else if(!empty($partial) && $partial == 'categories_list')
		{
			include 'categories_list.php';
		}
		else if(!empty($partial) && $partial == 'articles_list')
		{
			include 'articles_list.php';
		}
		else 
		{
			include 'admin_area.php';
		}
	?>


	</div>

</body>
</html>
