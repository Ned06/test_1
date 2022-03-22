<?php
session_start();
require_once("../bases/connexion.php");
require_once("../bases/function.php");
if(!isset($_SESSION['administrateur']) || empty($_SESSION['administrateur']->refUti)){
  header("Location: ../login.php");
  exit();
}




$totalTech = "SELECT COUNT(*) as total FROM utilisateur , type_utilisateur WHERE type_utilisateur.codeTypeUti = utilisateur.codeTypeUti ";
$totalTech = $pdo->query($totalTech);
$totalTech = $totalTech->fetch();
$totalTech = $totalTech->total;

$totalAdmin = "SELECT COUNT(*) as total FROM utilisateur , type_utilisateur WHERE type_utilisateur.codeTypeUti = utilisateur.codeTypeUti and type_utilisateur.codeTypeUti = '1' ";
$totalAdmin = $pdo->query($totalAdmin);
$totalAdmin = $totalAdmin->fetch();
$totalAdmin = $totalAdmin->total;

$totalInfo = "SELECT COUNT(*) as total FROM utilisateur , type_utilisateur WHERE type_utilisateur.codeTypeUti = utilisateur.codeTypeUti and type_utilisateur.codeTypeUti = '2' ";
$totalInfo = $pdo->query($totalInfo);
$totalInfo = $totalInfo->fetch();
$totalInfo = $totalInfo->total;

$totalStock = "SELECT COUNT(*) as total FROM utilisateur , type_utilisateur WHERE type_utilisateur.codeTypeUti = utilisateur.codeTypeUti and type_utilisateur.codeTypeUti = '4' ";
$totalStock = $pdo->query($totalStock);
$totalStock = $totalStock->fetch();
$totalStock = $totalStock->total;

$totalComm = "SELECT COUNT(*) as total FROM utilisateur , type_utilisateur WHERE type_utilisateur.codeTypeUti = utilisateur.codeTypeUti and type_utilisateur.codeTypeUti = '3' ";
$totalComm = $pdo->query($totalComm);
$totalComm = $totalComm->fetch();
$totalComm = $totalComm->total;

$totalDir = "SELECT COUNT(*) as total FROM utilisateur , type_utilisateur WHERE type_utilisateur.codeTypeUti = utilisateur.codeTypeUti and type_utilisateur.codeTypeUti = '5' ";
$totalDir = $pdo->query($totalDir);
$totalDir = $totalDir->fetch();
$totalDir = $totalDir->total;



?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Accueil</title>

   <!-- Custom fonts for this template-->
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
        <nav class="navbar navbar-expand navbar-danger bg-white topbar mb-4 static-top shadow">

            <!-- <a  href="int.php" class="btn btn-danger btn-md"><i class="fas fa-plus"> Nouvelle Intervention</i></a>&nbsp; -->
            <a  href="nouvUti.php" class="btn btn-danger btn-md"><i>Ajouter un Personnel</i></a>&nbsp;
            <!-- <a class="btn btn-danger btn-md" href="nouvClient.php"><i class="fas fa-plus"> Ajouter un personnel</i></a> -->


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
            </li>
          </ul>
        </nav>


        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">


          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">TABLEAU DE BORD</h1>
          </div>
           <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h6 class="h3 mb-0 text-gray-800">Intervention</h6>
           </div> -->
            <hr>
          <!-- Content Row interventions -->




          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h6 class="h3 mb-0 text-gray-800">Personnel</h6>

            </div>
            <hr>
          <!-- Content Row interventions -->
         <div class="row">



            <div class="col-xl-4 col-md-6 mb-4 animated slideInRight">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">TOTAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                      <div class="h5 mb-0 font-weight-bold text-black-800"><?=($totalTech); ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-xl-4 col-md-6 mb-4 animated slideInRight">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">ADMINISTRATEUR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                      <div class="h5 mb-0 font-weight-bold text-black-800"><?=($totalAdmin); ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4 animated slideInRight">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">INFORMATICIEN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                      <div class="h5 mb-0 font-weight-bold text-black-800"><?=($totalInfo); ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4 animated slideInRight">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">GESTIONNAIRE DE STOCKS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                      <div class="h5 mb-0 font-weight-bold text-black-800"><?=($totalStock); ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4 animated slideInRight">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">ASSISTANT DE DIRECTION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                      <div class="h5 mb-0 font-weight-bold text-black-800"><?=($totalDir); ?></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-xl-4 col-md-6 mb-4 animated slideInLeft">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">COMMERCIAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-success-800"><?=($totalComm); ?></div>
                        </div>
                        <div class="col">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            </div>
        </div>





      </div>


      <!-- End of Main Content -->

      <!-- Footer -->
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
          <button class="btn btn-danger" type="button" data-dismiss="modal">Retour</button>
          <form action="../logout.php" method="post">
            <button type="submit" name="logout" class="btn btn-success">Déconnexion</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->


  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
   <!-- Page level plugins -->



</body>

</html>
