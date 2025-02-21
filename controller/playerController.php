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
    
            if(!empty($this->getByEmail())){
                return "Cet email existe déjà !";
            }
    
            //J'enregistre mon utilisateur en bdd
            $account = [$firstname, $lastname, $email, $password];
            $this->getListModels()["accountModel"]->setAccount($account)->add();
        
            return "$firstname $lastname a été enregistré avec succès !";
        }
        return '';
    }

    public function displayForm(?string $message='',?string $messageSignIn=''):string{
        if(!isset($_SESSION['id'])){
            return '
            <section>
                <h1>Inscription</h1>
                <form action="" method="post">
                    <input type="text" name="lastname" placeholder="Le Nom de Famille">
                    <input type="text" name="firstname" placeholder="Le Prénom">
                    <input type="text" name="email" placeholder="L\'Email">
                    <input type="password" name="password" placeholder="Le Mot de Passe">
                    <input type="submit" name="submitSignUp">
                </form>
                <p>'. $message .'</p>
            </section>
            <section>
                <h1>Connexion</h1>
                <form action="" method="post">
                    <input type="text" name="emailSignIn" placeholder="L\'Email">
                    <input type="password" name="passwordSignIn" placeholder="Le Mot de Passe">
                    <input type="submit" name="submitSignIn">
                </form>
                <p>'.$messageSignIn.'</p>
            </section>';
        }
        return '';
    }

    public function displayAccount():string{
        //Récupération de la liste des utilisateurs
        $data = $this->getListModels()["accountModel"]->getAll();

        $listUsers = "";
        foreach($data as $account){
            $listUsers = $listUsers."<li><h2>".$account['firstname'] ." ". $account['lastname']."</h2>      <p>".$account['email']."</p></li>";
        }
        return $listUsers;
    }

    public function render():void{
        //D'abord on traite les données (ici : connexion et inscription)
        $messageSignIn = $this->signIn();
        $message= $this->signUp();

        //Puis on fait le rendu des vues
        $this->renderHeader();
        echo $this->getListViews()['accueil']->setForm($this->displayForm($message,$messageSignIn))->setListUsers($this->displayAccount())->displayView();
        $this->renderFooter();
    }
}