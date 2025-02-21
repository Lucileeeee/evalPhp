<?php
abstract class AbstractController {
    //ATTRIBUTS
    private ?ViewHeader $header;
    private ?ViewFooter $footer;
    private ?InterfaceModel $model;

    //CONSTRUCTEUR
    public function __construct(){
    }
    
    //GETTER ET SETTER
    public function getHeader(): ?ViewHeader { return $this->header; }
    public function setHeader(?ViewHeader  $header): self { $this->header = $header; return $this; }

    public function getFooter(): ?ViewFooter { return $this->footer; }
    public function setFooter(?ViewFooter $footer): self { $this->footer = $footer; return $this; }

    public function getModel(): ?InterfaceModel { return $this->model; }
    public function setModel(?InterfaceModel $model): self { $this->model = $model; return $this; }

    //METHOD
    public function render():void{}
}