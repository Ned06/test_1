<?php
session_start();
require_once("../bases/connexion.php");
require_once("../bases/function.php");
if(!isset($_SESSION['administrateur']) || empty($_SESSION['administrateur']->refUti)){
  header("Location: ../login.php");
  exit();
}

ini_set('display_error', 1);
require_once("../bases/connexion.php");



$recupChamp = "SELECT * FROM type_utilisateur";
$recupChamp = $pdo->query($recupChamp);
$recupChamp = $recupChamp->fetchAll();

$recupChampServ = "SELECT * FROM services";
$recupChampServ = $pdo->query($recupChampServ);
$recupChampServ = $recupChampServ->fetchAll();


if (isset($_POST['submit'])){
    if(!empty($_POST['nomUti']) and !empty($_POST['pnomUti']) and !empty($_POST['mailUti']) and !empty($_POST['contUti']) and !empty($_POST['adressUti']) and !empty($_POST['motpassUti'])){
      if (preg_match("#^[a-z0-9.-]+@[a-z0-9.-]{2,}\.[a-z]{2,4}$#", $_POST['mailUti'])){
        $req = $pdo->prepare('SELECT * FROM Utilisateur WHERE mailUti =?');
        $req->execute([
        $_POST['mailUti']
        ]);
        $req = $req->fetch();

        $rep = $pdo->prepare('SELECT * FROM utilisateur WHERE contUti =?');
        $rep->execute([
        $_POST['contUti']
        ]);
        $rep = $rep->fetch();

        if (($req && $rep) or ($req or $rep)) {
            danger("Email ou Contact déja Utilisé !");
        }elseif ((!$req && $rep) or (!$req or $rep)){
            $addUser = "INSERT INTO utilisateur(nomUti, pnomUti, mailUti, contUti, adressUti, motpassUti, codeTypeUti, refServices) VALUES (?,?,?,?,?,?,?,?)";
            $addUser = $pdo->prepare($addUser);
            $addUser = $addUser->execute([
            $_POST['nomUti'],
            $_POST['pnomUti'],
            $_POST['mailUti'],
            $_POST['contUti'],
            $_POST['adressUti'],
            password_hash($_POST['motpassUti'], PASSWORD_BCRYPT),
            $_POST['codeTypeUti'],
            $_POST['refServices']

            ]);

            $staTech = "UPDATE utilisateur set statutUti = ? WHERE mailUti = ?";
            $staTech = $pdo->prepare($staTech);
            $staTech ->execute([
              'DISPONIBLE',
              $_POST['mailUti']
            ]);
            success('Personnel ajouté !');
        }

      }
      else{
        danger("L'adresse Email entrée est invalide !");

      }

    }else{
      danger('Tous les champs doivent être completés !');
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

  <title>Nouveau Personnel</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
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
        <div class="text-left">
            <a class=" btn btn-primary btn-md" href="listePers.php"><i> Liste du personnel</i></a>
            <!-- <a class="btn btn-primary btn-md" href="int.php"><i class="fas fa-plus"> Nouvelle Intervention</i></a> -->
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
        <div class="container-fluid">

            <h1 class="animated bounceInDown text-primary">AJOUTER UN NOUVEAU PERSONNEL</h1>
            <hr>
            <?= getMessages(); ?>

            <br>
          <form class="animated bounceInDown text-dark" action="" id="defaultForm" method="post">
          <h6>Tous les champs avec un (*) sont réquis</h6>

            <div class="row">
              <div class="form-group col-md-4 mb-4">
              </div>
              <div class="form-group col-md-4 mb-4">
                <label for="nomUti">Nom<span> *</span> :</label>&nbsp;
                <input type="text" id="nomUti" maxlength="15"  name="nomUti"  required class="form-control form-control-md">
              </div>
              <div class="form-group col-md-4 mb-4">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-4 mb-4">
              </div>
              <div class="form-group col-md-4 mb-4">
                <label for="pnomUti">Prénoms<span> *</span> :</label>&nbsp;
                <input type="text" id="pnomUti" name="pnomUti"   maxlength="35" required class="form-control form-control-md">
              </div>
              <div class="form-group col-md-4 mb-4">
              </div>
            </div>

            <div class="row">
            <div class="form-group col-md-4 mb-4">
              </div>

              <div class="form-group col-md-4 mb-4">
                    <label for="mailUti">Email<span> *</span> :  </label>&nbsp;
                    &nbsp;<input type="email" name="mailUti"  id="mailUti"  maxlength="40" required class="form-control form-control-md">
              </div>
              <div class="form-group col-md-4 mb-4">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-4 mb-4">
              </div>
              <div class="form-group col-md-4 mb-4">
                    <label for="contUti">Contact<span> *</span> : </label>&nbsp;
                    &nbsp;<input type="tel" id="contUti"  name="contUti" maxlength="16" required  placeholder="+225 XX XX XX XX" pattern="\+?\d{2,3} \d{2} \d{2} \d{2} \d{2}" class="form-control form-control-md">
              </div>
              <div class="form-group col-md-4 mb-4">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-4 mb-4">
              </div>

              <div class="form-group col-md-4 mb-4">
                <label for="codeTypeUti">Profession<span> *</span> : </label>
                  <select id="codeTypeUti"  name="codeTypeUti" required class="form-control form-control-md">
                    <option value=""></option>
                      <?php foreach($recupChamp as $champ): ?>
                    <option value="<?=$champ->codeTypeUti; ?>"><?=$champ->descripTypeUti; ?></option>
                      <?php endforeach; ?>
                  </select>
              </div>
                <div class="form-inline col-md-4">
                </div>
            </div>

            <div class="row">
              <div class="form-group col-md-4 mb-4">
              </div>

              <div class="form-group col-md-4 mb-4">
                <label for="codeTypeUti">Service<span> *</span> : </label>
                  <select id="refServices"  name="refServices" required class="form-control form-control-md">
                    <option value=""></option>
                      <?php foreach($recupChampServ as $champ): ?>
                    <option value="<?=$champ->refServices; ?>"><?=$champ->descripServices; ?></option>
                      <?php endforeach; ?>
                  </select>
              </div>
                <div class="form-inline col-md-4">
                </div>
            </div>


            <div class="row">
              <div class="form-group col-md-4 mb-4">
              </div>
              <div class="form-group col-md-4 mb-4">
                 <label for="adressUti">Adresse<span> *</span> : </label>&nbsp;
                 <input type="text" id="adressUti"  maxlength="50" name="adressUti" required  class="form-control form-control-md">
              </div>
              <div class="form-group col-md-4 mb-4">
              </div>
            </div>



            <div class="row">
              <div class="form-group col-md-4 mb-4">
              </div>
              <div class="form-group col-md-4 mb-4">
                  <label for="motpassUti">Mot de passe par défaut<span> *</span> : </label>&nbsp;
                  <input type="password" name="motpassUti"  id="motpassUti" maxlength="60" required class=" form-control form-control-md">
              </div>
              <div class="form-group col-md-4 mb-4">
              </div>
            </div>





              <br>


            <div class="text-center">
              <button type="reset" class="btn btn-danger btn-lg">ANNULER</button>
              <button type="submit" name="submit"  class="btn btn-success btn-lg">AJOUTER</button>
            </div>


          </form>
        </div>
<br><br><br>

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
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Retour</button>
          <form action="../logout.php" method="post">
            <button type="submit" name="logout" class="btn btn-primary">Déconnexion</button>
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
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>
  <script src="../vendor/bootstrap/validate/bootstrapValidator.js"></script>


</body>

</html>





