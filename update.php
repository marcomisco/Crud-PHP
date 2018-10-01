<?php

	if(isset($_GET["id"])){
		$id = $_GET["id"];
	}
	try
	{
		$bd = new PDO('mysql:host=localhost;dbname=crudtest;charset=utf8', 'root', '12345678');
	}catch(Exception $e)
	{
	  die('Erreur : '.$e->getMessage());
	}
	if (isset($_POST['button'])) {
		// $id=$_POST['idPERSONNES'];
		print_r($_POST);
		$nom = filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING);
		$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
		$telephone = filter_var($_POST['telephone'], FILTER_SANITIZE_NUMBER_INT);
		$valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);

		$sql = "UPDATE crud SET pseudo= :pseudo, email=:email, telephone= :telephone 
		WHERE idpers=:id";
		$req = $bd->prepare($sql);
		$req->bindParam(':pseudo', $nom);
		$req->bindParam(':telephone', $telephone);
		$req->bindParam(':email', $valid_email);
		$req->bindParam(':id', $id);
		$req->execute();
		header('location:read.php'); //change de page apres execute
	}
	
		$resultat=$bd->prepare('SELECT * FROM crud WHERE idpers=:id');
		$resultat->bindParam(':id', $id);
		$resultat->execute();
		$donnes=$resultat->fetch();
		
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>contact</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="../CRUD/read.php">Liste des contacts</a>
	<h1>Modifier</h1>
    <form action="" method="post">
			<input type="hidden" name="idpers" value="<?= $donnes["idpers"];?>">
      <label for="pseudo">Nom : </label>
      <input type="text" name="pseudo" value="<?= $donnes["pseudo"];?>"><br>

      <label for="email">Prenom : </label>
      <input type="email" name="email"  value="<?= $donnes["email"];?>"><br>

      <label for="telephone">Téléphone : </label>
      <input type="number" name="telephone"  value="<?= $donnes["telephone"];?>"><br>


			<button type="submit" name="button">Modifier</button>
		</form>
</body>
</html>
