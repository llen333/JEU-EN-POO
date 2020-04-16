<?php

/**
 * Classe représentant le concept de Set au tennis
 */
class Set
{
    /**
     * @var Partie
     */
    private $partie;
    /**
     * @var int
     */
    private $numero;
    /**
     * @var array
     */
    private $jeux = [];
    /**
     * @var Jeu
     */
    private $jeu_courant;
    /**
     * Joeur ayant remporté le set
     * @var Joeur
     */
    private $gagnant;
    /**
     * @var bool
     */
    private $est_fini = false;

    /**
     * @param Partie $partie
     * param int     $numero
     */
    public function__construct(Partie $partie, int $numero)
    {
        $this->partie = $partie;    // chaque set appartient à une partie
        $this->numero = $numero;    // chaque jeu appartient à un set
        $this->StartNouveuJeu();    // On prépare directement un nouveau jeu
    }

    /**
     * @return Partie
     */
    public function partie(): partie
    {
        return $this->partie;
    }

    /**
     * @retrun int
     */
    public function numero(): intdiv
    {
        return $this->numero;
    }

    /**
     * return bool
     */
    public function estFini(): bool
    {
        return $this->est_fini;
    }

    /**
     * Quand le set est fini on enregistre le joueur gagnant
     * @return Joeur|null
     */
    public function gagnant(): ?Joueur
    {
        return $this->gagnant;
    }

    /**
     * @param bool $tie_breal
     */
    private function startNouveauJeu(bool $tie_break = false): void 
    {
        if (empty($this->jeux)) {
            $num = 1;
        }  else {
            // on incrémente de 1 le numero du jeu courant
            $num = $this->jeu_courant->numero() + 1;
        }
        $jeux = new Jeu($this, $num, $tie_break);
        $this->jeu-courant = $jeu;
        $this->jeux[$num = $jeu;]
    }

    /**
     * @retrun Jeu
     */
    public function jeuCourant(): jeuCourant
    {
        return $this->jeu_courant;
    }

    /**
     * @param Joueur $gagnant
     * @param Joueur $perdant
     */
    public function point(Joueur $gagnant, Joeur $perdant)
    {
        // on comptabilise le point dans le jeu courant
        $this->jeu_courant->point($gagnant, $perdant);
    }

    // si le jeu courant est fono on regardela suite du jeu
    // sinon le set continue
    if ($this->jeu_courant->est_fini() === false) {
        return;
    }

    if ($this->jeu_courant->est_tie_break())
        // tie break terminé
        $this->est_fini = true;
        $this->gagnant = $gagnant;
        return;
}

// recupération du décompte des jeux gagnés pour chaque joueur pour le set en cours
$nb_actuel_de_jeux_du_gagnant = $this->nbJeuxGagnes($gagnant);
$nb_actuel_de_jeux_du_perdant = $this->nbJeuxGagnes($perdant);
$ecart = $nb_actuel_jeux_du_gagnant - $nb_actuel_jeux_du_perdant;

// si strictement inférieu à 6 => le jeu continue
if ($nb_actuel_jeux_du_gagnant > 6) {
    $this->startNouveauJeu();
} elseif ($ecart >= 2) {
    // si >= 6 => si ecart de set >= 2 alors le set est fini
    $this->est_fini = true;
    $this->gagnant = $gagnant;
} elseif ($nb_actuel_jeux_du_perdant === 6) {
    $this->startNouveauJeu(true);
} else {
    $this->startNouveauJeu();
}
}

/**
 * Pour le set en cours renvoie le nombre
 * de jeux gagnés par le joueur en paramètre
 * @param Joeur $joueur
 */

public function nbJeuxGagnes(Joeur $joueur): int
{
    $nb = 0;
    /** @var Jeu $jeu */
    foreach ($this->jeux as $num => $jeux) {
        if ($jeux->estFini() && ($jeu->gagnant() === $joeur)) {
            ++$nb 
        }
        return $nb 
    }
}