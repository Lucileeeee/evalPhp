<?php
//LE CONTROLLER pour la class PlayerController
class PlayerController extends AbstractController {
    //ATTRIBUS
    private ?ViewPlayer $player;

    //GETTER ET SETTER 
    public function getPlayer(): ?ViewPlayer { return $this->player; }
    public function setPlayer(?ViewPlayer $player):self{ $this->player = $player; return $this; }

    //METHOD
    public function addPlayer():?string{
        if(isset($_POST['submit'])){
            if(empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['password'])){
                return "Veuillez remplir les champs !";
            }
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                return "Email pas au bon format !";
            }
            $pseudo = sanitize($_POST['pseudo']);
            $email = sanitize($_POST['email']);
            $password = sanitize($_POST['password']);
    
            $password = password_hash($password, PASSWORD_BCRYPT);
    
            if(!empty($this->getByEmail())){//!
                return "Cet email existe déjà !";
            }
            $this->addPlayer($pseudo, $email, $password);
            return "Utilisateur a été enregistré avec succès !";
        }
        return '';
    }


    public function render():void{
        //D'abord on traite les données (ici : connexion et inscription)
        $messageSignIn = $this->addPlayer();
       //todo $message= $this->signUp();

        //todo Puis on fait le rendu des vues
    }
}