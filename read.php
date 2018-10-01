<?php
	try
	{
	$bd = new PDO('mysql:host=localhost;dbname=crudtest;charset=utf8', 'root', '12345678');
		//DELETE
		if (isset($_POST["delete"])) {
				$remove= $bd->prepare('DELETE FROM crud WHERE idpers=:id');
				$remove->bindParam(':id', $id);
				$id=$_POST["delete"];
				$remove->execute();
		};
  $resultat = $bd->query('SELECT * FROM crud ORDER BY pseudo ASC');
	$donnees='';
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>contact</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  </head>
  <body>
    <h1>Liste des contacts</h1>
		<form class="" action="" method="post">
	    <table>
				<th>id</th>
		    <th>Pseudo</th>
				<th>email</th>
				<th>Telephone</th>
		  <?php while ($donnees= $resultat ->fetch() ){ ?>
		    <tr>
					<td><?= $donnees['idpers'];?></td>
		      <td><?= $donnees['pseudo']; ?></td>
		      <td><?= $donnees['email']; ?></td>
		      <td><?= $donnees['telephone']; ?></td>
					<td><a href="../CRUD/update.php?id=<?= $donnees['idpers']; ?>">Modifier</a> </td>
					<td ><button type="submit" name="delete" value="<?= $donnees['idpers'] ?>"><i class="far fa-trash-alt"></i></button></td>
				</tr>
				<?php
			} ?>
				<tr>
					<button type="submit" name="create"><a href="../CRUD/create.php?id=<?= $donnees['idpers']; ?>">Ajouter</i></button>
				</tr>
	    </table>
		</form>
  </body>
</html>
