<?php
session_start();
require_once("../bases/connexion.php");
require_once("../bases/function.php");
if(!isset($_SESSION['administrateur']) || empty($_SESSION['administrateur']->refUti)){
  header("Location: ../login.php");
  exit();
}
require_once("../bases/connexion.php");

$tach = $_GET['tach'] ?? '';
if($tach !== ''){
  $taache = "SELECT idTache, utilisateur.refUti, utilisateur.nomUti, utilisateur.pnomUti, dateTache, descripTache, detailTache, natureTache FROM taches , utilisateur WHERE utilisateur.refUti = taches.refUti AND idTache=? ";
  $taache = $pdo->prepare($taache);
  $taache->execute([$tach]);
  $taache = $taache->fetch();
  
  if(!$taache){
    header("Location: tache.php");
    exit();
  }
}else{
    header("Location: tache.php");
    exit();
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

  <title>Affectation de tâche</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../vendor/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../css/animate.css" rel="stylesheet">
   <link href="../css/moncss.css" rel="stylesheet">
</head>

<body id="page-top" class="">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-danger accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="text-light"><img src="../img/logo.png" alt="logo"></i>
        </div>
        <div class="sidebar-brand-text mx-2 animated text-light heartBeat">GOUABO</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Tableau de Bord -->
      <li class="nav-item active text-light">
        <a class="nav-link text-light" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt text-light"></i>
          <span text-light >Tableau de Bord</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">




      <li class="nav-item text-light">
        <a class="nav-link collapsed text-light" href="listePers.php">
          <i class="fas fa-desktop text-light"></i>
          <span text-light>Personnel</span>
        </a>

      </li>

      <li class="nav-item text-light">
        <a class="nav-link collapsed text-light" href="gestCont.php">
          <i class="fas fa-file-signature text-light"></i>
          <span text-light>Gerer les contrats</span>
        </a>

      </li>

      <li class="nav-item">
        <a class="nav-link collapsed text-light" href="tache.php">
          <i class="far fa-clock text-light"></i>
          <span>Affecter une tâche</span>
        </a>
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
        <div class="text-right">
            <a class="btn btn-primary btn-md" href="listeTache.php"><i>Liste des tâches</i></a>
            <a class="btn btn-primary btn-md" href="listePers.php"><i>Liste du Personnel</i></a>

          </div>

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">






            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item no-arrow">
              <!-- Dropdown - User Information -->

                <a class="" href="login.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Déconnexion
                </a>
              </div>
            </li>

          </ul>

        </nav>

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class=" container">
            <h1 class="text-center text-dark mb-5">TACHE N°<?= $taache->idTache ?></h1>
          <div class="row text-center text-dark mb-5">
            <h2 class="col-6 "><span class="text-danger">ID DU PERSONNEL EN CHARGE DE LA TÂCHE :</span> <?= $taache->refUti ?></h2>
            <h2 class="col-6"><span class="text-danger">NOM & PRENOM PERSONNEL EN CHARGE DE LA TÂCHE :</span> <?= $taache->nomUti ?> <?= $taache->pnomUti ?> </h2>
          </div>
          <div class="row text-center text-dark mb-5">
            <h1 class="col-6"><span class="text-danger">DATE D'AFFECTATION DE LA TÂCHE :</span> <?= $taache->dateTache ?></h1>
            <h1 class="col-6"><span class="text-danger">NATURE DE LA TÂCHE :</span> <?= $taache->natureTache ?></h1>
          </div>
          <div class="row text-center text-dark mb-5">
            <h1 class="col-12"><span class="text-danger">LES DETAILS DE LA TÂCHE :</span> <?= $taache->detailTache ?></h1>
            
          </div>
        </div>
      <br><br><br<br><br><br<br><br><br<br><br><br<br><br><br<br><br><br<br><br><br<br>

      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

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
            <button type="submit" name="logout" class="btn btn-primary">Déconnexion</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Modal -->

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>
  <script src="../vendor/bootstrap/validate/bootstrapValidator.js"></script>


</body>

</html>
