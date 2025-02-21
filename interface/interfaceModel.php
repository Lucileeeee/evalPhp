<?php
//LE FICHIER POUR L'INTERFACE InterfaceModel

interface InterfaceModel {
    public function add():string;
    public function getAll():array | null;
}