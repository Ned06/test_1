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

/*$Utionnel = "SELECT refUti, nomUti, pnomUti, mailUti, adressUti FROM Utilisateur , type_Utilisateur WHERE Utilisateur.codeTypeUti = typeUtilisateur.codeTypeUti AND  typeUtilisateur.descripTypeUti = 'Technicien' ";

$Utionnel = mysqli_query($connexion, $Utionnel);*/
if(isset($_GET["employer"]))
{
  
    $employer = $_GET["employer"];
    $contrat = "SELECT utilisateur.refUti, type_contrat.reftypCont, refCont, descripCont, datedebutCont, datefinCont, nomUti, pnomUti, descriptypCont FROM contrat, type_contrat, utilisateur WHERE contrat.refUti = :contUti AND utilisateur.refUti = :employer AND type_contrat.reftypCont = contrat.reftypCont";
    $contrat = $pdo->prepare($contrat);
    $contrat->execute(array(
                          'contUti'=>$employer,
                          'employer'=>$employer
                      ));
    $contrat = $contrat->fetchAll();  


}
else{
  die("Erreur de con");
}

$recupChamptypeCont = "SELECT * FROM type_contrat";
$recupChamptypeCont = $pdo->query($recupChamptypeCont);
$recupChamptypeCont = $recupChamptypeCont->fetchAll();

if(isset($_POST["Edit"]))
{
  if(isset($_POST["descrip_typ_contrat"]))
  {
    $typeCont=$_POST["descrip_typ_contrat"];
    $inputTypeCont = $pdo->prepare("UPDATE contrat SET reftypCont=:typCont WHERE refUti=:employer");
    $inputTypeCont->execute(array(
                              'typCont'=>$typeCont,
                              'employer'=>$employer
                            ));
  }
  if(isset($_POST["date_debut_contrat"]))
  {
    $dateDebut=$_POST["date_debut_contrat"];
    $inputDebutCont = $pdo->prepare("UPDATE contrat SET datedebutCont=:debutCont WHERE refUti=:employer");
    $inputDebutCont->execute(array(
                              'debutCont'=>$dateDebut,
                              'employer'=>$employer
                            ));
    
  }
  if(isset($_POST["date_fin_contrat"]))
  {
    $dateFin=$_POST["date_fin_contrat"];
    $inputFinCont = $pdo->prepare("UPDATE contrat SET datefinCont=:finCont WHERE refUti=:employer");
    $inputFinCont->execute(array(
                              'finCont'=>$dateFin,
                              'employer'=>$employer
                            ));
  }
  if(isset($_POST["descrip_contrat"]))
  {
    $descripCont=$_POST["descrip_contrat"];
    $inputFinCont = $pdo->prepare("UPDATE contrat SET descripCont=:descripCont WHERE refUti=:employer");
    $inputFinCont->execute(array(
                              'descripCont'=>$descripCont,
                              'employer'=>$employer
                            ));
  }
  info('Contrat du personnel modifi??');
  header("Location: listeCont.php");
}
// if (isset($_POST['disponible'])) {
//   $Personnel = "SELECT refUti, nomUti, pnomUti, mailUti, contUti, adressUti, motpassUti, descripTypeUti, statutUti FROM utilisateur , type_utilisateur WHERE utilisateur.codeTypeUti = type_utilisateur.codeTypeUti AND type_utilisateur.descripTypeUti = 'Personnel'  AND utilisateur.statutUti = 'DISPONIBLE'";
//   $Personnel = $pdo->query($Personnel);
//   $Personnel = $Personnel->fetchAll();
// }
// if (isset($_POST['indisponible'])) {
//   $Personnel = "SELECT refUti, nomUti, pnomUti, mailUti, contUti, adressUti, motpassUti, descripTypeUti, statutUti FROM utilisateur , type_utilisateur WHERE utilisateur.codeTypeUti = type_utilisateur.codeTypeUti AND type_utilisateur.descripTypeUti = 'Personnel'  AND utilisateur.statutUti = 'INDISPONIBLE'";
//   $Personnel = $pdo->query($Personnel);
//   $Personnel = $Personnel->fetchAll();
// }
// if (isset($_POST['tous'])) {
//   $Personnel = "SELECT refUti, nomUti, pnomUti, mailUti, contUti, adressUti, motpassUti, descripTypeUti, statutUti FROM utilisateur , type_utilisateur WHERE utilisateur.codeTypeUti = type_utilisateur.codeTypeUti AND type_utilisateur.descripTypeUti = 'Personnel'  AND utilisateur.statutUti = 'INDISPONIBLE'";
//   $Personnel = $pdo->query($Personnel);
//   $Personnel = $Personnel->fetchAll();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Liste des Contrats</title>

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
          <span>Affecter une t??che</span>
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
            <a class="btn btn-primary btn-md" href="nouvUti.php"><i> Nouveau Personnel</i></a>
            <a class=" btn btn-primary btn-md" href="listeCont.php"><i> Voir les contrats</i></a>
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
                  D??connexion
                </a>
              </div>
            </li>

          </ul>

        </nav>

        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="animated rotateInUpLeft text-primary">MODIFICATION DU CONTRAT</h1>

            <hr>

            <form action="" method="post">
            <div>
            <!-- <button class="text-left btn btn-danger" name="toutes" type="submit">TOUS</button>
              <button class="text-left btn btn-danger" name="indisponible" type="submit">INDISPONIBLE</button>
              <button class="text-right btn btn-danger" name="disponible" type="submit">DISPONIBLE</button>
            </div> -->
          <br>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
              <div class="card-box table-responsive">
              <table  class="table table-striped table-bordered dataTable text-dark" role="grid" aria-describedby="dataTable_info" id="dataTable" cellspacing="0" style="width: 100%">

            
            
            <tbody>
              <?php foreach($contrat as $data){ ?>
              <tr>
                  <th scope="col">NOM</th>
                  <td><?php echo $data->nomUti; ?></td>
              </tr>
              <tr>
                  <th scope="col">PRENOMS</th>
                  <td><?php echo $data->pnomUti; ?></td>
              </tr>
              <tr>
                  <th scope="col">TYPE DE CONTRAT</th>
                  <td>
                      <!--<input type="text" name="descrip_typ_contrat" placeholder="<?php echo $data->descriptypCont; ?>">-->
                      <select id="descrip_typ_contrat"  name="descrip_typ_contrat" required class="form-control form-control-md">
                        <option value="<?php echo $data->descriptypCont; ?>"></option>
                          <?php foreach($recupChamptypeCont as $champ): ?>
                        <option value="<?=$champ->reftypCont; ?>"><?=$champ->descriptypCont; ?></option>
                          <?php endforeach; ?>
                      </select>
                  </td>
                  
              </tr>
              <tr>
                  <th scope="col">DATE DE DEBUT </th>
                  <td><input type="date" name="date_debut_contrat" value="<?php echo $data->datedebutCont; ?>"></td>
              </tr>
              <tr>
                  <th scope="col">DATE DE FIN</th>
                  <td><input type="date" name="date_fin_contrat" value="<?php echo $data->datefinCont; ?>"></td>
              </tr>
              <tr>
                  <th scope="col">DESCRIPTION</th>
                  <td><input type="text" name="descrip_contrat" placeholder="<?php echo $data->descripCont; ?>"></td>
              </tr>
                
                

              
              
              <?php } ?>
            </tbody>
          </table>
                <button type="submit" name="Edit" class="btn btn-success btn-lg">Valider</button>
                <button type="reset" class="btn btn-danger btn-lg">ANNULER</button>
          </form>
        </div>
      </div>
    </div>
  </div>
 </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

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
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pr??t ?? partir ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">??</span>
          </button>
        </div>
        <div class="modal-body">Cliquer sur "D??connexion" si vous ??tes pr??t ?? fermer la session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Retour</button>
          <form action="../logout.php" method="post">
            <button type="submit" name="logout" class="btn btn-primary">D??connexion</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Delete Modal-->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment supprimer ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">??</span>
          </button>
        </div>
        <div class="modal-body">Cliquer sur "Supprimer" si vous voulez vraiment le supprimer.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Retour</button>
          <form action="deleteTech.php?tech=<?= $data->refUti; ?>" method="post">
            <button type="submit" name="delete" href="deleteTech.php?tech=<?= $data->refUti; ?>" class="btn btn-danger">Supprimer</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>






  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendor/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
      <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
   <script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').dataTable( {
            "language": {
  "sEmptyTable":     "Aucune donn??e disponible dans le tableau",
  "sInfo":           "Affichage de l'??l??ment _START_ ?? _END_ sur _TOTAL_ ??l??ments",
  "sInfoEmpty":      "Affichage de l'??l??ment 0 ?? 0 sur 0 ??l??ment",
  "sInfoFiltered":   "(filtr?? ?? partir de _MAX_ ??l??ments au total)",
  "sInfoPostFix":    "",
  "sInfoThousands":  ",",
  "sLengthMenu":     "Afficher _MENU_ ??l??ments",
  "sLoadingRecords": "Chargement...",
  "sProcessing":     "Traitement...",
  "sSearch":         "Rechercher :",
  "sZeroRecords":    "Aucun ??l??ment correspondant trouv??",
  "oPaginate": {
    "sFirst":    "Premier",
    "sLast":     "Dernier",
    "sNext":     "Suivant",
    "sPrevious": "Pr??c??dent"
  },
  "oAria": {
    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
    "sSortDescending": ": activer pour trier la colonne par ordre d??croissant"
  },
  "select": {
          "rows": {
            "_": "%d lignes s??lectionn??es",
            "0": "Aucune ligne s??lectionn??e",
            "1": "1 ligne s??lectionn??e"
          }
  }
}
        } );
    } );
</script>
  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>
    <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>


</body>

</html>
