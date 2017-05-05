<?php
// On test si le pseudo existe, et si il existe bien, que le mot de passe saisi est correct
function check_user($xml,$id,$pwd){
	$test=false;
	foreach($xml->user as $u){
		$pseudo = (string)$u->pseudo;
		$pass = (string)$u->pass;
		if($pseudo==$id and $pass==$pwd){
			$test=true;
		}
	}
	return $test;
}

// Fonction principale de connexion
function connexion(){
	//Chargement fichier XML
	$xml_file=simplexml_load_file('../../data/users.xml');
	// On gère les erreurs éventuelles
	if(isset($_POST['identifiant']) and isset($_POST['password'])){
		// On vérifie si les informations saisies sont correctes
		if(check_user($xml_file,$_POST['identifiant'],$_POST['password'])){
			echo 'Connexion réussie !';
		}else{
			echo 'Pseudo ou mot de passe incorrect. Vérifiez la saisie.';
		}
	}else{
		echo 'Erreur dans la saisie. Vérifiez que tous les champs aient été remplis.';
	}
}

//On appelle la fonction
connexion();

?>