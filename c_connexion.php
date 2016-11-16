﻿<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch($action){
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	case 'valideConnexion':{
		$login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
		$visiteur = $pdo->getInfosVisiteur($login,$mdp);
		if(!is_array( $visiteur)){
			ajouterErreur("Login ou mot de passe incorrect");
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
		else if(is_array( $visiteur)){
			$id = $visiteur['id'];
			$nom =  $visiteur['nom'];
			$prenom = $visiteur['prenom'];
			connecter($id,$nom,$prenom);
			include("vues/v_sommaire.php");
		}
        // si l'admin se connecte
        else if(is_array( $admin)){
            $id = $admin['id'];
			$nom =  $admin['nom'];
			$prenom = $admin['prenom'];
			connecter($id,$nom,$prenom);
			include("vues/v_sommaire.php");
        }
        // si un comptable se connecte
        else if(is_array( $comptable)){
            $id = $comptable['id'];
			$nom =  $comptable['nom'];
			$prenom = $comptable['prenom'];
			connecter($id,$nom,$prenom);
			include("vues/v_sommaire.php");
        }
		break;
	}
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>
