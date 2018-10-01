<?php
  try
    {
      if (isset($_POST["delete"])) 
        {
          foreach ($_POST["delete"] as $todel) 
            {
              $remove= $bdd->prepare('DELETE FROM crud WHERE pseudo=:nom');
              $remove->bindParam(':nom', $nom);
              $nom=$todel;
              $remove->execute();
              header('refresh:0');
            }
        }

      }
      catch(Exception $e)
      {
        die('Erreur : '.$e->getMessage());
      }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <section>
        <form action="" method="post">
          <label for="pseudo">Nom : </label>
          <input type="text" name="pseudo" id="pseudo"><br>

          <label for="email">Email: </label>
          <input type="text" name="email" id="email"><br>

          <label for="telephone">Téléphone : </label>
          <input type="number" name="telephone" id="telephone"><br>


          <button type="submit" name="delete">Supprimer</button>
      </form>
    </section>
  </body>
</html>
