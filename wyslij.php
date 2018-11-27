<?php
session_start();
echo $_SESSION['username'];

				$dbhost="serwer1812376.home.pl"; 
				$dbuser="28879196_cloud"; 
				$dbpassword="Dominik123123"; 
				$dbname="28879196_cloud"; 

					
				$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
						if (!$polaczenie) {
							echo "Błąd połączenia z MySQL." . PHP_EOL;
							echo "Errno: " . mysqli_connect_errno() . PHP_EOL; echo "Error: " . mysqli_connect_error() . PHP_EOL; exit;
						}
				$result = mysqli_query($polaczenie,"SELECT * FROM sciezki WHERE user = '{$_SESSION['username']}'");

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Adding, Deleting, View Files</title>
  </head>
  <body>
	<div class="row d-flex justify-content-center mt-5">
		<div class="d-flex">
			<form action="odbierz.php" method="POST" ENCTYPE="multipart/form-data"> <input type="file" name="plik"/> 
				<input type="submit" value="Wyślij plik"/> 
			</form>
		</div></div>
			<div class="row d-flex justify-content-center mt-5">
		<div class="d-flex">
			
		<form method="post">
			<div class="form-group">
    	<label for="exampleFormControlSelect1">Wybierz Plik</label>
    	<select name="plik" class="form-control" id="exampleFormControlSelect1">
		<?php while ($wiersz = mysqli_fetch_array ($result)){ ?>
      	<option value="<?php echo $wiersz[0]; ?>"><?php echo $wiersz[1];?></option>
		<?php } ?>
    </select>
				<button type="submit" name="usun" class="btn btn-primary">usuń</button>
				<button type="submit" name="pobierz" class="btn btn-primary">Pobierz</button>
				
			</form>
  </div> 
		</div>
	  </div>

	<?php
		if(isset($_POST['usun'])){
			$idpliku=$_POST['plik'];
			$result2 = mysqli_query($polaczenie,"SELECT*FROM sciezki WHERE id = '$idpliku' ");
			$wiersz1 = mysqli_fetch_array($result2);
			
			$nazwapliku = $wiersz1[1];
			//http://teamrudoblond.info.pl<?php echo $rekord[2].$rekord[1];
			mysqli_query($polaczenie,"DELETE FROM sciezki WHERE id = '$idpliku'");
			$sciezkapliku = '/dominik_zalewski/z7/cloud/'. $_SESSION['username'] .'/' . $wiersz1[1];
			//echo $sciezkapliku = '/dominik_zalewski/z7/cloud/'. $_SESSION['username'] .'/' . $nazwapliku;
			unlink($sciezkapliku);
			
		}elseif(isset($_POST['pobierz'])){
			$idpliku=$_POST['plik'];
			$result3 = mysqli_query($polaczenie,"SELECT*FROM sciezki WHERE id = '$idpliku' ");
			$wiersz2 = mysqli_fetch_array($result3);
			//echo $sciezkapliku2 = '/dominik_zalewski/z7/cloud/'. $_SESSION['username'] .'/' . $wiersz2[1];
			$sciezkapliku2 = '/dominik_zalewski/z7/cloud/'. $_SESSION['username'] .'/' . $wiersz2[1];
			echo "<a target='_blank' href='".$sciezkapliku2."'>Pobierz ".$wiersz2[1]."</a>";
		}
	?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>