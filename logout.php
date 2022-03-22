<?php
session_start();
require_once("bases/connexion.php");


  if(isset($_POST['logout'])){
    if($_SESSION['Personnel']){
      $refUti = $_SESSION['Personnel']->refUti;
      $dernier = "SELECT `presenceId` FROM `presence` WHERE refUti= $refUti ORDER BY `presenceId` DESC LIMIT 1 ";
      $dernier = $pdo->query($dernier);
      $dernier = $dernier->fetchAll();
      foreach($dernier as $data){
        $presencee = (int)$data->presenceId;
      }
      
    
      
    
      
        $heureDepart = date('h:i:s');
        $presence = "UPDATE presence set heureDepartPresence = ? WHERE presenceId = ?";
        $presence = $pdo->prepare($presence);
        $presence = $presence->execute([
          $heureDepart,
          $presencee
       ]);
    }
 
      unset($_SESSION['administrateur'], $_SESSION['Personnel']);
      session_destroy();
      header("Location: login.php");
      exit();
  }

