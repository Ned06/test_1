<?php
session_start();
require_once("../bases/connexion.php");
require_once("../bases/function.php");
if(!isset($_SESSION['Personnel']) || empty($_SESSION['Personnel']->refUti)){
  header("Location: personnel.php");
  exit();
}




if (isset($_POST['submit'])) {

    $password = $_POST['motpassUti'];

    // $_POST['motpassUti'] =  password_hash($_POST['motpassUti'], PASSWORD_BCRYPT);
    $req = "SELECT motpassUti FROM utilisateur , type_utilisateur WHERE utilisateur.codeTypeUti = type_utilisateur.codeTypeUti";
    $req = $pdo->query($req);
    $req = $req->fetch();
    
    
        if(password_verify($password, $req->motpassUti)){
         
          
            if (($_POST['NmotpassUti1']) === ($_POST['NmotpassUti2'])) {
                $reqq = "UPDATE utilisateur set motpassUti = ? WHERE refUti = ?";
                $reqq = $pdo->prepare($reqq);
                $reqq->execute([
            password_hash($_POST['NmotpassUti1'], PASSWORD_BCRYPT),
            (int) $_SESSION['Personnel']->refUti

          ]);
                success('Mot de passe modifié avec success');
            } else {
                danger('Les mots de passe ne correspondent pas !');
            }
        } else {
            danger("L'ancien mot de passe que vous avez saisie est incorrecte !");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Nouveau mot de passe</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../css/animate.css" rel="stylesheet">
   <link href="../css/moncss.css" rel="stylesheet">
</head>

<body id="page-top" class="">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Personnel.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-hard-hat"></i>
        </div>
        <div class="sidebar-brand-text mx-3 animated heartBeat">OUTIL D'INTERVENTION</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">



      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="Personnel.php">
          <i class="far fa-clock"></i>
          <span><u>Intervention</u></span>
        </a>
      </li>
        <!-- <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Menu :</h6>
            <a class="collapse-item" href="sesInt.php">SES INTERVENTIONS</a>
            <a class="collapse-item" href="intEff.php">INTERV EFFECTUEES</a>
          </div>
        </div>
      </li> -->

      <hr class="sidebar-divider d-none d-md-block">

      <li class="nav-item active">
        <a class="nav-link" href="newPassword.php">
          <i class="fas fa-fw fa-cog"></i>
          <span>  Changer de mot de passe</span></a>
      </li>



      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>



          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control-plaintext form-control bg-light border-0 small" placeholder="Rechercher..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>
            <!-- Nav Item - User Information -->
            <li class="nav-item no-arrow">
              <!-- Dropdown - User Information -->

                <a class="" href="login.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Déconnexion
                </a>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->
        <br>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <h1 class="animated bounceInDown text-dark">Changement de mot de passe</h1>
          <hr>
          <?= getMessages(); ?>
          <br>

          <form class="animated bounceInDown text-dark" id="defaultForm" action="" method="post">
            <h6>Tous les champs avec un (*) sont réquis</h6>

            <div class="row">
              <div class="form-group col-md-4 mb-4">
              </div>
              <div class="form-group col-md-4 mb-4">
                <label for="motpassUti">Entrer votre mot de passe actuel<span> *</span> : </label>&nbsp;
                <input type="password" id="motpassUti" name="motpassUti" maxlength="60"  required  class="form-control form-control-md">
              </div>
              <div class="form-inline col-md-4 mb-4">
              </div>
            </div>

            <div class="row">
              <div class="form-inline col-md-4 mb-4">
              </div>
              <div class="form-group col-md-4 mb-4">
                <label for="motpassUti1">Entrer votre nouveau mot de passe<span> *</span> : </label>&nbsp;
                <input type="password" id="motpassUti1" name="NmotpassUti1" maxlength="60"  required class="form-control form-control-md">
              </div>
              <div class="form-inline col-md-4 mb-4">
              </div>
            </div>

            <div class="row">
              <div class="form-inline col-md-4 mb-4">
              </div>
              <div class="form-group col-md-4 mb-4">
                <label for="motpassUti2">Confirmer votre nouveau mot de passe<span> *</span> : </label>&nbsp;
                <input type="password" id="motpassUti2" name="NmotpassUti2" maxlength="60" required   placeholder=""  class="form-control form-control-md">
              </div>
              <div class="form-inline col-md-4 mb-4">
              </div>
            </div>

            <div class="text-center">
              <button type="reset" class="btn btn-danger btn-lg">ANNULER</button>
              <button type="submit" name="submit" class="btn btn-success btn-lg">VALIDER</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

  

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Prêt à partir ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Cliquer sur "Déconnexion" si vous êtes prêt à fermer la session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Retour</button>
          <form action="../logout.php" method="post">
            <button type="submit" name="logout" class="btn btn-danger">Déconnexion</button>
          </form>
        </div>
      </div>
    </div>
  </div>


    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <!-- <script src="../js/sb-admin-2.min.js"></script> -->

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>
  <script type="text/javascript">
$(document).ready(function() {
    $('#defaultForm').bootstrapValidator({
        message: 'La valeur entrer est invalide',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            motpassUti: {
                message: "Entrer votre mot de passe",
                validators: {
                    notEmpty: {
                        message: "L'ancien mot de passe est réquis et ne peut être vide'"
                    },
                    stringLength: {
                        min: 4  ,
                        max: 60,
                        message: 'Veillez entrer un nom avec plus de 4 caracteres'
                    },
                }
            },
           


 


   
        }
    });
});
</script>