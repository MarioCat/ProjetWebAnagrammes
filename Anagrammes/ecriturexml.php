<?php

$xml=simplexml_load_file('meuble.xml');
$u=$xml->addChild('item');
$u['name']='Commode';
$u->addChild('prix','3');
$u->addChild('quantite','2');


if(!$xml->asXML('meuble.xml')){
	echo 'Impossible de sauver le fichier.';
}

?>

