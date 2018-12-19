<!DOCTYPE html>
<html>
	<head>
		<meta name="eduki-mota" content="text/html;" http-equiv="content-type" charset="utf-8">
		<title>Log in</title>
		<link rel='stylesheet' type='text/css' href='../styles/style.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
			   href='../styles/wide.css' />
		<link rel='stylesheet' 
			   type='text/css' 
			   media='only screen and (max-width: 480px)'
			   href='../styles/smartphone.css' />
		<script src="../js/jquery-3.2.1.js"></script>
	</head>
	<body>
		<div id='page-wrap'>
			<header class='main' id='h1'>
				<span class="right"><a href="login.php">LogIn</a> </span>
				<span><a href="signUp.php">SignUp</a> </span>
				<a id="backButton" href=javascript:history.go(-1);> <img src="../images/atrás.png" width="40" height="40"></a>
				<h2>Aldatu Pasahitza</h2>
			</header>
			
			<nav class='main' id='n1' role='navigation'>
				<span><a href='layout.php'>Home</a></span>
				<span><a href='layout.php'>Quizzes</a></span>
				<span><a href='credits.php'>Credits</a></span>
				
			</nav>
			
			<section class="main" id="s1">
				<div>				
				<form action="aldatuPasahitza.php" method="post" enctype="multipart/form-data">
					Eposta (*): <input type="text" class="input" name="eposta" size="50"/> <br><br>
					Pasahitz berria (*): <input type="password" class="input" name="pasahitza" size="50"/> <br><br>
					Pasahitza errepikatu (*): <input type="password" class="input" name="pasahitzaerre" size="50"/> <br><br>
					
					<input type="submit" name="berrezarri" value="   Berrezarri   "/>
					<input type="reset" name="garbitu" value="     Garbitu     "/>
				</form>
				</div>
				
			</section>

			<footer class='main' id='f1'>
				<a href='https://github.com'>Link GITHUB</a>
			</footer>
		</div>	
	</body>
</html>

<?php

	$email = $_POST['eposta'];
	$newpw = $_POST['pasahitza'];
	$repeat = $_POST['pasahitzaerre'];
	echo '<script> console.log("Emaila: '.$email.' \n Pasahitz berria: '.$newpw.' \n Pasahitza errepikatuta: '.$repeat.' \n POGGERS "); </script>';

	if (isset($_POST['pasahitza']) && isset($_POST['eposta']) && isset($_POST['pasahitzaerre'])) {
		
		if ($newpw == $repeat) {
			
			include("dbConfig.php");
			$linki= mysqli_connect($zerbitzaria,$erabiltzailea,$gakoa,$db);
			
			if(!$linki) echo '<script> console.log("Konexio errorea"); </script>';
			else {
				
				$data = $linki->query("SELECT * FROM users WHERE eposta='".$email."'");		
				if($data->num_rows != 0) {

					$erabiltzailea = $data->fetch_assoc();
					$id = $erabiltzailea['ID'];
					$action = $linki->query("UPDATE users SET pasahitza = '".$newpw."' WHERE ID = ".$id." ");
					if ($action) {
						echo "<script>location.href='login.php';</script>";
					} else {
						echo '<script> console.log("Ezin izan da UPDATEa zuzen egin"); </script>';
					}
					
				} else {
					echo '<script> console.log("Erabiltzaile hori ez da existitzen"); </script>';
				}
			}

		} else {
			echo '<script> console.log("Bi pasahitzak ez dira berdinak!"); </script>';
		}
	}

?>