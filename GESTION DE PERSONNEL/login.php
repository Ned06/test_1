<?php

session_start();
require_once("bases/connexion.php");


if(isset($_SESSION['administrateur']) && !empty($_SESSION['administrateur']->refUti)){
  header("Location: ADMINISTRATEUR/index.php");
  exit();
} elseif(isset($_SESSION['Personnel']) && !empty($_SESSION['Personnel']->refUti)){
  header("Location: PERSONNEL/personnel.php");
  exit();
}




if (isset($_POST['submit'])){

$login = htmlspecialchars($_POST['mailUti']);
$password = $_POST['motpassUti'];
$ref = NULL ;

  if (!empty($login) AND !empty($password)) {
    /*$reqlogin = "SELECT mailUti , motpassUti  FROM Utilisateur WHERE mailUti = '".$login."' AND motpassUti = '".$password."'";

    $reqlogin = mysqli_query($connexion, $reqlogin);*/

    $user = "SELECT refUti, nomUti, pnomUti, mailUti, motpassUti, contUti, adressUti, utilisateur.codeTypeUti, descripTypeUti FROM utilisateur, type_utilisateur WHERE mailUti = :mailUti AND utilisateur.codeTypeUti = type_utilisateur.codeTypeUti";
    $user = $pdo->prepare($user);
    $user->execute(
      ['mailUti' => $login]

    );

     $user = $user->fetch();
    if(password_verify($password, $user->motpassUti)){
      unset($user->motpassUti);
      if($user->descripTypeUti === "Administrateur"){
        $_SESSION['administrateur'] = $user;


        header("Location: ADMINISTRATEUR/index.php");
        exit();
      } else{
        $_SESSION['Personnel'] = $user;
        $date = date('d-m-y');
        $heure = date('h:i:s');
        $id = $_SESSION['Personnel']->refUti;
        $presence = "INSERT INTO presence(jourPresence, heureArriveePresence, refUti ) VALUES (?, ? , ?)";
        $presence = $pdo->prepare($presence);
            $presence = $presence->execute([
            $date,
            $heure,
            $id ]);
        header("Location: PERSONNEL/personnel.php");
        exit();
      }

     }
     else{
       $erreur = "Utilisateur Introuvable !";
    }
  }
  else{
  $erreur = "Tous les champs doivent être completés !";
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/moncss.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
</head>

<body class="bg-success animated zoomInDown">
	<div class="container">
		<div class="row">
			<div class="bloc-rgba">
				<div class="bloc-rgba-1">

				</div>
				<div class="bloc-rgba-2">
					<div class="bloc-rgba-2-chlid">
          <?php
          if (isset($erreur)){
            echo '<font color="red">'.$erreur.'</font>';
          }
           ?>
					    <h1 class="text-dark">BIENVENUE !</h1>
					   <p class="text-dark">Authentifiez Vous !</p>
					    <br><br><br>

            <form action="" method="post">

              <div class="form-group">
                <div class="row">
                  <label>ADRESSE EMAIL</label>
                  <input type="email" name="mailUti" id="mailUti" class="form-control">
                </div>
              </div>
              <br>
              <div class="form-group">
                <div class="row">
                  <label>MOT DE PASSE</label>
                  <input type="password" name="motpassUti" id="motpassUti" class="form-control">
                </div>
              </div>
                <br><br>

                <input id="submit" type="submit" class="btn btn-danger" name="submit" value="CONNECTEZ-VOUS">
            </form>






	  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>
</html>
