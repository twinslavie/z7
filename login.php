<?php 
function redirection(){
    //remeber session
    /* Redirect browser */
    header("Location: wyslij.php");
	}
session_unset();
session_start();
//echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

						$dbhost="serwer1812376.home.pl"; 
						$dbuser="28879196_cloud"; 
						$dbpassword="Dominik123123"; 
						$dbname="28879196_cloud"; 
		
				function secure_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
				//secure_input(
		if(isset($_POST['submit'])){
		$login=secure_input($_POST['login']);
		$pass=secure_input($_POST['pass']);
		$ipaddress=$_SERVER["REMOTE_ADDR"];
		$user_agent=$_SERVER["HTTP_USER_AGENT"];
		
		//BAZADANYCH POŁĄCZENIE I ZCZYTANIE WARTOŚCI
		$polaczenie = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
		if(!$polaczenie) {echo "Nie można połączyć z". mysqli_connect_errno()." ".mysqli_connect_error() ;}
		
		$rezultat = mysqli_query($polaczenie,"SELECT * FROM Users WHERE login ='$login' LIMIT 1");
		
		$wiersz = mysqli_fetch_array($rezultat);
			
		//SPRAWDZENIE WARTOSCI PROBY JESLI 1 TO JEST NAŁOŻONA BLOKADA JEŚLI 0 MOŻNA SIĘ LOGOWAĆ
			
		if($wiersz[5] == '1'){
			
				$odliczanie = mysqli_query($polaczenie,"SELECT COUNT(*) as COUNTALL FROM user_log WHERE ip_address LIKE '$ipaddress' AND time > (now() - interval 1 minute)");
				while($zlicz=mysqli_fetch_array($odliczanie)){
					$liczba_prob = $zlicz['COUNTALL'];
				}
			
				if($liczba_prob > 2){
					echo "<br/><span id='error'>Nałożono blokadę po 3 próbach zalogowania, odczekaj 10 min</span>";
					
				}elseif($liczba_prob == 0){
					mysqli_query($polaczenie,"UPDATE Users SET proby = 0, time=now() WHERE login='$login'");
					echo "<br/><span id='error'>Odświerz portal i zaloguj się ponownie</span>";
					
					
				}
			}
		//LOGOWANIE ORAZ DODAWANIE WARTOSCI I PRÓB LOGOWANIA	
		if($wiersz[4] === $pass){
			mysqli_query($polaczenie,"UPDATE Users SET proby = 0 WHERE login='$login'");
			mysqli_query($polaczenie,"INSERT INTO user_log (id,login,time,ip_address,u_agent,poprawnosc) VALUES (NULL,'$login',now(),'$ipaddress','$user_agent','Tak')");
			
	
			$_SESSION["username"]=$login;
			$_SESSION["user_id"]=$wiersz[0];
			$_SESSION['logowanie']=0;
			redirection();
			
			}else{
				if(!isset($_SESSION['logowanie'])){
					$logowanie=1;
				}else{
					$logowanie=$_SESSION['logowanie']+1;
				}
				echo "<br/><span id='error'>Błędne dane, próba $logowanie</span>";

				$_SESSION['logowanie']=$logowanie;

				mysqli_query($polaczenie,"INSERT INTO user_log (id,login,time,ip_address,u_agent,poprawnosc) VALUES (NULL,'$login',now(),'$ipaddress','$user_agent','Nie')");

				if($logowanie === 3){
					session_unset();
					mysqli_query($polaczenie,"UPDATE Users SET proby = 1, time=now() WHERE login='$login'");
					echo "<br/><span id='error'>Nałożono blokadę!</span>";
				}
		}
			
	}

	
		
		?>
		
		
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Login in</title>
  </head>
  <body>
	  
	 <div class="row d-flex justify-content-center mt-5">
	<div class="d-flex">
		
			<form method="POST">
				
			  <div class="form-group">
				<label for="exampleInputlogin1">Login</label>
				<input name="login" type="login" class="form-control" placeholder="Login">
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Hasło</label>
				<input name="pass" type="password" pattern=".{4,}" class="form-control" id="password" placeholder="Password">

			  <button type="submit" name="submit" class="btn btn-primary">Zaloguj się</button>
		</form>		

	  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>