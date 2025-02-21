<?php
/**
 * Fonction de nettoyage de données
 *@param string $data
 *@return string la donnée nettoyée
*/
function sanitize($data){
    return htmlentities(strip_tags(stripslashes(trim($data))));
}

/**
 * Fonction de création de l'objet de connexion PDO
 * TODO : configurer correctement les paramètres du constructeur
 *@return PDO l'objet de connexion à la bdd
*/
function connect(){
    return new PDO('mysql:host=;dbname=','','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}

?>