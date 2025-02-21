<?php
//LA VIEW POUR LA CLASS ViewPlayer
class ViewPlayer implements AbstractController{
    //ATTRIBUT
    private ?string $signUpMessage = '';
    private ?string $playerList ='';

    //GETTER ET SETTER
    public function getSignUpMessage(): ?string { return $this->signUpMessage; }
    public function setSignUpMessage(?string $signUpMessage): self { $this->signUpMessage = $signUpMessage; return $this; }

    public function getPlayerList(): ?string { return $this->playerList; }
    public function setPlayerList(?string $playerList): self { $this->playerList = $playerList; return $this; }


    //METHOD
    public function displayView():string{
        ob_start();
?>
        <h1>Ajouter un Player</h1>
        <form action="" method="post">
            <input type="text" name="pseudo" placeholder="pseudo">
            <input type="email" name="email" placeholder="email">
            <input type="password" name="password" placeholder="Mot de Passe">
            <input type="submit" value="ajouter" name="submit">
        </form>
  
<?php
        return ob_get_clean();
    }
}


