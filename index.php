<?php      session_start();        ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Mon blog</title>
</head>
<body>
    
     <h1>Mon super blog</h1>

     <p>Derniers billets du blog : </p>

     <?php
      
      include('connect.php');

      $req = $bdd->query('SELECT id, titre, content, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0,5');
      while ($donnees = $req -> fetch()) {
        ?>
        <div class="news">
        <?php
           echo('<h3>'.htmlspecialchars($donnees['titre']).'! '.$donnees['date_creation_fr'].'</h3>');  ?>

<?php  echo('<p>'.htmlspecialchars($donnees['content']).' <br><br>
           <em><a href="commentaires.php?billet='.$donnees['id'].'">Commentaires</a></em></p>'); 
           
           ?>
           
       </div>
       <?php
      }
        $req ->closeCursor();
      ?>
    </body>
</html>