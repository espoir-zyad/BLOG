<?php
session_start(); 
$_SESSION['date'] = date('yy-m-d H:i:s');
include('connect.php');
$req = $bdd -> prepare('INSERT INTO commentaires( id_billet,auteur, commentaire, date_commentaire) VALUES (:id_billet, :auteur, :commentaire, :date_commentaire)');
$req->execute(array(
    'id_billet' => $_SESSION['id_billet'],
    'auteur' => $_POST['auteur'],
    'commentaire' => $_POST['commentaire'],
    'date_commentaire' => $_SESSION['date']
    ));

    header('Location: commentaires.php?billet='.$_SESSION['id_billet'].'');


?>