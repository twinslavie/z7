<?php 
	function redirection(){
  
    /* Redirect browser */  
    header("Location: member.php");
	}

//echo $_SERVER['HTTP_USER_AGENT'] . "\n\n";

$browser = get_browser(null,true);

$przegladarka = $browser[parent];
$system = $browser[platform];
				function secure_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
				//secure_input(
			
if(isset($_POST["submit"])){  
  
if(!empty($_POST['login']) && !empty($_POST['pass'])) {  
$login = $_POST['login'];
$pass =  secure_input($_POST['pass']); 
  	
	$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
						if (!$polaczenie) {
							echo "Błąd połączenia z MySQL." . PHP_EOL;
							echo "Errno: " . mysqli_connect_errno() . PHP_EOL; echo "Error: " . mysqli_connect_error() . PHP_EOL; exit;
						}
  
mysqli_query($polaczenie, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$result = mysqli_query($polaczenie, "SELECT * FROM Users WHERE login='$login' AND pass='$pass'"); // pobranie z BD wiersza, w którym login=login z formularza

$rekord = mysqli_fetch_array($result);// wiersza z BD, struktura zmiennej jak w BD
if(!$rekord) //Jeśli brak, to nie ma użytkownika o podanym loginie
{
mysqli_close($polaczenie); // zamknięcie połączenia z BD
echo "Brak użytkownika o takim loginie !"; // UWAGA nie wyświetlamy takich podpowiedzi dla hakerów
}
else
{ // Jeśli $rekord istnieje
if($rekord['pass']==$pass & $rekord['login']==$login) // czy hasło zgadza się z BD
{	
session_start();
redirection();
}
else
{
mysqli_close($polaczenie);
echo "Błąd w haśle !"; // UWAGA nie wyświetlamy takich podpowiedzi dla hakerów
}
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