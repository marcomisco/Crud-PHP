<?php
try
  {
  $bdd = new PDO('mysql:host=localhost;dbname=crudtest;charset=utf8', 'root', '12345678');
  }
  catch(Exception $e)
  {
    die('Erreur : '.$e->getMessage());
  }
  //afficher les personnes
  $contact = $bdd->query('SELECT * FROM crud');

  $message = "";
    // isset= si form remplis et create=button 
    //sanatization
  if(isset($_POST['create'])){
    $pseudo = filter_var($_POST['pseudo'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telephone = filter_var($_POST['telephone'], FILTER_SANITIZE_STRING);
    $valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);
// si remplis on fait fonction
  if(!empty($pseudo) && !empty($email) && !empty($telephone && !empty($valid_email))) {
    //insérer dans base de données
    $add_value = $bdd->prepare('INSERT INTO crud (pseudo, email, telephone) VALUES(:pseudo, :email, :telephone)');
    //Lie un paramètre à un nom de variable
    $add_value->bindParam(':pseudo', $pseudo);
    $add_value->bindParam(':email', $valid_email);
    $add_value->bindParam(':telephone', $telephone);
    //executer
    $add_value->execute();
    header('location:read.php'); //change de page apres execute
    $message = "A été ajoutée !";
  }else{
    $message = "N'a pas été ajoutée !";
    }
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <a href="./read.php">Liste des contacts</a>
    <section>
    <!-- on utilise method post -->
    <form action="" method="post">
      <label for="pseudo">Nom : </label>
      <input type="text" name="pseudo"><br>

      <label for="email">email : </label>
      <input type="email" name="email"><br>

      <label for="telephone">Téléphone : </label>
      <input type="tel" name="telephone" ><br>

      <button type="submit" name="create">Ajouter</button>
      <!-- affiche message -->
      <?php echo $message; ?>
    </form>
    </section>
  </body>
</html>
