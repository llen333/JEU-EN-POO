<?php

/** 
 * Classe representant le concept de Joueur
*/

class Joueur
{
    private $id;
    private $nom;
    private $prenom;

    public function __construct($id, string $nom, string $prenom)
    {
        $this->id       = $id;
        $this->nom      = $nom;
        $this->prenom   = $prenom;
    }

    public function id()
    {
        return $this->id;
    }

    public function nom(): string
    {
        return $this->nom;
    }

    public function prenom(): string
    {
        return $this->prenom;
    }

    public function nomComplet(): string
    {   return $this->prenom. ' '.$this->nom;
    }
}
