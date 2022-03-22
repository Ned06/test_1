<?php 
	session_start();
	require_once("../bases/connexion.php");
	require_once("../bases/function.php");
	require("../fpdf/fpdf.php");
	if(!isset($_SESSION['administrateur']) || empty($_SESSION['administrateur']->refUti)){
	  header("Location: ../login.php");
	  exit();
	}

	/**
	 * 
	 */
	class PDF extends FPDF
	{
		//En tete
		function Header()
		{
			$this->image('../img/logo.png');

			//Police Arial Gras Taille 20
			$this->SetFont('Arial','B',20);

			//Nom de l'entreprise
			$h = 4;
			$this->Write($h,"ECO GOUABO\n\n");

			//Information de localisation
			$this->SetFont('Arial','B',10);
			$h = 4;
			$retrait = "      ";
			$this->Write($h,"DEUX PLATEAUX non loin de l'eglise MEFORD\n");
			$this->Write($h,"21 BP 1500 Abidjan 21 - Côte d'Ivoire\n");
			$this->Write($h,"CEL : 0768518708/ Site : ecogouabo.com");

			//Saut de ligne
			$this->Ln(18);
			//Police Arial gras 16
			$this->SetFont('Arial','B',12);
			//Titre
			$this->Cell(0,10,'LISTING DES CONTRAT','TB',1,'C');
			$this->Ln(6);
		}
		
		function Footer()
		{
			//Positionnement à 1,5cm du bas
			$this->SetY(-15);
			//Police Arial Italique 8
			$this->SetFont('Arial','I',8);

			//Numéro de page
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

			//Date heure et edition du document
			$Cejour = date("Y-m-d");
			$Heure = date("H:i");
			$dFact0 = explode("-", $Cejour);
			$jourFact0 = $dFact0[2]."/".$dFact0[1]."/".$dFact0[0];
			$this->Cell(0,10,'Edité le '.$jourFact0.' à '.$Heure.' par '.$_SESSION['administrateur']->refUti,0,0,'R');
		}
	}
	    
	    $contrat = "SELECT * FROM contrat";
	    $contrat = $pdo->query($contrat);
	    $contrat = $contrat->fetchAll();
	    

	    //Instanciation de la classe dérivée
		$pdf = new PDF('P','mm','A4');
		$pdf->AddPage();

		//Nom et Prénom
		/*$pdf->SetFont('Arial','B',11);
		$pdf->Cell(40,7,'NOM ET PRENOM',0,0,'C');
		$pdf->Cell(45,6,$emp->nomUti.' '.$emp->pnomUti,0,0,'C');
		$pdf->Ln();*/

		// Titres des colonnes
		$pdf->SetFont('Arial', 'B', 11);
		$header = array('NOM ET PRENOMS', 'DATE DE DEBUT','DATE DE FIN', 'DESCRIPTION');
		$pdf->AliasNbPages();
		

		// Largeurs des colonnes
		$w = array(55,40,40,60);

		// En-tête
		for($i=0;$i<count($header);$i++) 
			$pdf->Cell($w[$i],7,$header[$i],1,0,'C');
		$pdf->Ln();
		foreach ($contrat as $value) :

			$contRefUti = $value->refUti;
			
			$query = $pdo->prepare("SELECT * FROM utilisateur WHERE refUti=?");
			$query->execute(array($contRefUti));
			$donne = $query->fetch();
			
			$nomUti = $donne->nomUti.' '.$donne->pnomUti;
			
			
			
				
			
			$dateBegin = $value->datedebutCont;
			$dateEnd = $value->datefinCont;
			$descip = $value->descripCont;

			$pdf->SetFont('Arial','',10);

			$pdf->Cell($w[0],6,$nomUti,1,0,'C');
			$pdf->Cell($w[1],6,$dateBegin,1,0,'C');
			$pdf->Cell($w[2],6,$dateEnd,1,0,'C');
			$pdf->Cell($w[3],6,$descip,1,0,'C');
			$pdf->Ln();
		endforeach;

		//trait de terminaison
		$pdf->Cell(array_sum($w),0,'','');
		$pdf->Output();
	

	

 ?>