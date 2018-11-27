<?php
session_start();
echo $_SESSION['username'];




// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.
				$dbhost="serwer1812376.home.pl"; 
				$dbuser="28879196_cloud"; 
				$dbpassword="Dominik123123"; 
				$dbname="28879196_cloud"; 

					
				$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
						if (!$polaczenie) {
							echo "Błąd połączenia z MySQL." . PHP_EOL;
							echo "Errno: " . mysqli_connect_errno() . PHP_EOL; echo "Error: " . mysqli_connect_error() . PHP_EOL; exit;
						}

$uploaddir = '/dominik_zalewski/z7/cloud/'. $_SESSION['username'] .'/';
$uploadfile = $uploaddir . basename($_FILES['plik']['name']);

echo '<pre>';
if (move_uploaded_file($_FILES['plik']['tmp_name'], $uploadfile)) {
	
	 $filename = $_FILES['plik'][name];
	
	
	$result = mysqli_query($polaczenie,"INSERT INTO sciezki (`id`,`name`,`dir`,`time`,user) 
	VALUES (NULL,'$filename','$uploaddir',now(), '{$_SESSION['username']}')");
	
	
} else {
    echo "Possible file upload attack!\n";
}

echo 'Here is some more debugging info:';
print_r($_FILES);

print "</pre>";

?>
<a href="wyslij.php">PLIKI</a>
