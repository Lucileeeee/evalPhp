<?php
//MODEL POUR LA CLASS ModelPlayer

class PlayerModel extends AbstractController{
    //ATTRIBUT
    private ?int $id;
    private ?string $pseudo;
    private ?string $email;
    private ?int $score;
    private ?string $password;
    private ?PDO $bdd;
    public function __construct(?PDO $bdd){
        $bdd = connect();
        $this->bdd = $bdd ; 
    }
    //!GETTER ET SETTER
    public function getId(): ?int { return $this->id; }
    public function setId(?int $id):self{ $this->id = $id; return $this; }

    public function getPseudo(): ?string { return $this->pseudo; }
    public function setPseudo(?int $pseudo):self{ $this->pseudo = $pseudo; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?int $email):self{ $this->email = $email; return $this; }

    public function getScore(): ?int { return $this->score; }
    public function setScore(?int $score):self{ $this->score = $score; return $this; }

    public function getPassword(): ?string { return $this->password; }
    public function setPassword(?int $password):self{ $this->password = $password; return $this; }


    //METHOD
    public function add():string{
        $message ='';
        try{
            $bdd = $this->bdd;
            $pseudo = $this->getPseudo();
            $email = $this->getEmail();
            $score = $this->getScore();
            $password = $this->getPassword();

            $requete = "INSERT INTO players(pseudo, email, score, psswrd)
            VALUE(?,?,?,?)";
            $req = $bdd->prepare($requete);
            $req->bindParam(1,$pseudo, PDO::PARAM_STR);
            $req->bindParam(2,$email, PDO::PARAM_STR);
            $req->bindParam(3,$score, PDO::PARAM_INT);
            $req->bindParam(4,$password, PDO::PARAM_STR);
            $req->execute();
            $message = 'Utilisateur enregistré en Bdd !';
        }
        catch(Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
        return $message;
    }
    public function getAll():array | null{
        try {
            $bdd = $this->bdd;
            $requete = "SELECT id, pseudo, email, score FROM players";
            $req = $bdd->prepare($requete);
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    public function getByEmail():array | null{
        try {
            $bdd = $this->bdd;
            $email = $this->getEmail();
            $requete = "SELECT id, pseudo, email, score, psswrd FROM  players
            WHERE email = ?";
            $req = $bdd->prepare($requete);
            $req->bindParam(1,$email, PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}