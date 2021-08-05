<?php
  require 'config/config.php';

  if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $userDetailsQuery = mysqli_query($con, "select * from users where username='$userLoggedIn'");
    $user = mysqli_fetch_array($userDetailsQuery);
  } else {
    header('location:register.php');
  }
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Socail Network</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

		<!-- Boot css -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">

		<!-- Boot js -->
		<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-popRpmFF9JQgExhfw5tZT4I9/CI5e2QcuUZPOVXb1m7qUmeR2b50u+YFEYe1wgzy" crossorigin="anonymous">
		</script>

		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

		<!-- Style css -->
		<link rel="stylesheet" href="assets/css/style.css" />

	</head>

	<body>

		<div class="top_bar">
			<div class="logo">
				<a href="index.php">Social Site</a>
			</div>

			<nav>
				<a href="<?=$userLoggedIn;?>">
					<?php echo $user['first_name']; ?>
				</a>
				<a href="index.php"><i class="fas fa-home"></i></a>
				<a href="#"><i class="far fa-envelope"></i></a>
				<a href="#"><i class="fas fa-bell"></i></a>
				<a href="#"><i class="fas fa-users"></i></a>
				<a href="#"><i class="fas fa-cog"></i></a>
				<a href="includes/handlers/logout.php"><i class="fas fa-sign-out-alt"></i></a>
			</nav>
		</div>

		<div class="wrapper">