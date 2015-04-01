
<?php
	require "fonctions.php";
	
	//Déclaration variables
		$tabCouts = array();
		$cout = 0; //coût global
		$tempsAssistant = 0; //temps pour un assistant (en minutes)
		$tempsAssocie = 0; //temps pour un associé (en minutes)
		$coutHoraireAssistant = 1.25; // 75€ / h
		$coutHoraireAssocie = 2; // 120€ / h
		$coutSalarie = 20; //20€ mensuel par salarié
		
		// variables
		$factures_achat = $_POST['factures_achat'];
		$factures_vente = $_POST['factures_ventes'];
		$salaries = $_POST['salaries'];

		//Estimation du temps mensuel
		$tempsAssistant += $factures_achat  * 2; //factures achat
		$tempsAssistant += $factures_vente * 2; //factures vente
		$tempsAssistant += ($factures_achat  + $factures_vente); //banque
		$tempsAssistant += 15; //tva
		$tempsAssistant += 15; //autres taxes
		$tempsAssistant += (($factures_achat  * 2) + ($factures_vente  * 2) + ($factures_achat  + $factures_vente )) * 0.1; //OD
		$tempsAssocie += ($tempsAssistant + 960) * 0.15; //supervision (on intègre 960 min (temps annuel et non mensuel !)
		$tempsAssistant += 80; //bilan (960 / 12 soit 80min par mois)

		//calcul du coût
		$cout += $tempsAssistant * $coutHoraireAssistant; //coût assistant
		$cout += $tempsAssocie * $coutHoraireAssocie / 12; //coût associé
		$cout += $salaries * $coutSalarie;  //salariés 
		$cout = round($cout);
		if ($cout < 250) {  //coût minimum fixé à 250€
			$cout = 250;
		}

		$resultat = array('min' => custom_round($cout * 0.9),
			'max' => custom_round($cout * 1.1)
		);

		echo json_encode($resultat);


	


