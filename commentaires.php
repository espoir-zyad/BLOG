<?php      session_start();        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Commentaires</title>
</head>
<body>

 <h1>Mon super blog</h1>

 <a href="index.php">Retour à la liste des billets</a>
    <?php  
    
      include('connect.php');
       
      $req = $bdd -> prepare('SELECT id, titre, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id=?');
      $req -> execute(array($_GET['billet']));

      $donnees = $req -> fetch();

      ?>
        <div class="news">
        <?php
           echo('<h3>'.htmlspecialchars($donnees['titre']).'! '.$donnees['date_creation_fr'].'</h3>');  ?>

<?php  echo('<p>'.htmlspecialchars($donnees['content']).' <br><br>');
   $_SESSION['id_billet'] = $donnees['id'];

?>
           
       </div>
       
       <?php
    
        $req ->closeCursor();
    
         
$reponse = $bdd -> prepare('SELECT id, id_billet, auteur, commentaire,
DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS
date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY
date_commentaire DESC');
$reponse -> execute(array($_GET['billet']));

while ($debor = $reponse -> fetch()) {
    ?>
   <?php  echo('<strong>'.$debor['auteur'].'</strong> :' .$debor['commentaire'].'  '.$debor['date_commentaire_fr'].'<br><br>');      ?>
   <?php
}
  $reponse ->closeCursor();
?>


<form action="commentaires_post.php" method="POST">

<label for=""><strong>Votre commentaire</strong></label><br>
<label for="auteur">Pseudo</label>
<input type="text" name="auteur"><br><br>
<label for="commentaire">Commentaire</label>
<input type="text" name="commentaire"><br><br>
<input type="submit" value="Envoyer">

</form>
</body>
</html>