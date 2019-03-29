<?php include '../classes/AdminLogin.php'; ?>

<?php

$adminLogin = new AdminLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $adminUser = $_POST['username'];
  $adminPass = $_POST['password'];

	$loginCheck = $adminLogin->adminLogin($adminUser, $adminPass);
}


 ?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<?php if (isset($loginCheck)): ?>
				<p style="font-size: 18px; color:red;"><?php echo $loginCheck; ?></p>
				<br>
			<?php endif; ?>
			<div>
				<input type="text" placeholder="Username"  name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
