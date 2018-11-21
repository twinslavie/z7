<?php
function redirection(){
    //remeber session
    /* Redirect browser */  
    header("Location: login.php");
	}



						if (!$polaczenie) {
							echo "Błąd połączenia z MySQL." . PHP_EOL;
							echo "Errno: " . mysqli_connect_errno() . PHP_EOL; echo "Error: " . mysqli_connect_error() . PHP_EOL; exit;
						}
						$users = mysqli_query($polaczenie,"SELECT * FROM Users");
						$usercheck = mysqli_fetch_array($users);
						

			$imie = $_POST['imie'];
			$nazwisko = $_POST['nazwisko'];
			$login = $_POST['login'];
			$pass = $_POST['pass'];
			
			
			if (IsSet($_POST['submit'])) {
				if($usercheck[3] !== $login){
					
				mkdir('./cloud/'.$login, 0777, true);
				
			mysqli_query($polaczenie,"INSERT INTO Users (`userid`,`imie`,`nazwisko`,`login`,`pass`)
			VALUES (NULL,'$imie','$nazwisko','$login','$pass')");
					
				session_start();
				redirection();
				
				}
				else{
					echo "Podany Login już istnieje w bazie";
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

    <title>Sign in</title>
  </head>
  <body>
	 <div class="row d-flex justify-content-center mt-5">
	<div class="d-flex">
		
			<form method="POST" target="login.php">
			  <div class="form-group">
				<label for="exampleInputPassword1">Imie</label>
				<input name="imie" type="text"  class="form-control" placeholder="Imię">
			  </div>
				<div class="form-group">
				<label for="exampleInputPassword1">Nazwisko</label>
				<input name="nazwisko" type="text" class="form-control"  placeholder="Nazwisko">
			  </div>
			  <div class="form-group">
				<label for="exampleInputEmail1">Login</label>
				<input name="login" type="login" class="form-control" placeholder="Login">
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Hasło</label>
				<input name="pass" type="password" pattern=".{4,}" class="form-control" id="password" placeholder="Password">
			  </div>
				<div class="form-group">
				<label for="exampleInputPassword1">Potwierdź hasło</label>
				<input type="password" class="form-control" pattern=".{4,}" id="confirm_password" placeholder="Password">
			  </div>
			  <button type="submit"  name="submit" class="btn btn-primary">Zarejestruj się</button>
		</form>
		<script>
			var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

			function validatePassword(){
			  if(password.value != confirm_password.value) {
				confirm_password.setCustomValidity("hasła nie są poprawne");
			  } else {
				confirm_password.setCustomValidity('');
			  }
			}

			password.onchange = validatePassword;
			confirm_password.onkeyup = validatePassword;
		
		</script>
	</div>
</div>
	  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>