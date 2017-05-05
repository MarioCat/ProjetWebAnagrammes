<?php
//Ajout utilisateur
function adduser($xml,$mail,$id,$pwd){
	$u=$xml->addChild('user');
	$u['mail']=$mail;
	$u->addChild('pseudo',$id);
	$u->addChild('pass',$pwd);

	if(!$xml->asXML('users.xml')){
		echo 'Impossible de sauver le fichier.';
	}
}
//Renvoi un booléen pour voir si le pseudo est déjà pris
function unicite_pseudo_mail($xml,$id,$mail){
	$test=true;
	foreach($xml->user as $u){
		$pseudo = (string)$u->pseudo;
		$mel = (string)$u['mail'];
		if($pseudo==$id or $mel==$mail){
			$test=false;
		}
	}
	return $test;
}

// Fonction générale qui reçoit les informations saisies par l'utilisateur
function testAddUser(){
	//Chargement fichier XML
	$xml_file=simplexml_load_file('../../data/users.xml');
	// On regarde si tous les champs ont été remplis
	if(isset($_POST['identifiant']) and isset($_POST['email']) and isset($_POST['password'])){
		// On teste l'unicité du pseudo/mail
		if(unicite_pseudo_mail($xml_file,$_POST['identifiant'],$_POST['email'])){
			// Si tel est le cas, on ajoute l'utilisateur au fichier xml
			adduser($xml_file,$_POST['email'],$_POST['identifiant'],$_POST['password']);
			echo 'Félicitations vous êtes inscrit !';
		}else{
			// Sinon on lui renvoie un message d'erreur
			echo 'Pseudo déjà pris ou mail déjà utilisé.';
		}
	}else{
		// On affiche un message d'erreur si un des champs n'est pas remplie
		echo 'Erreur dans la saisie. Vérifiez que tous les champs soient complétés.';
	}
}

//On execute la fonction
testAddUser();

?>