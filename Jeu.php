<?php

/**
 * Classe représentant le concept de Jeu au tennis
 */
class Jeu
{
    /** @var set
     * 
     */
    private $set;
    /** @var int
     * 
     */
    private $numero;
    /**
     * A chaque coup joué, on suit les scores
     * [num coup joué =>[joueur1 => score, joueur2 => score]]
     * @var array
     */
    private $score = [];
    /**
     * Joueur ayant remporté le set
     * @var Joueur
     */
    private $gagnant;
    /**
     * Indique si le set est fini
     * @var bool
     */
    private $est_fini = false;
    /**
     * @var array suivi du score du tie_break
     */
    private $tie_break = [];

    /**
     * @param Set $set
     * @param int $numero
     * @param bool tie_break
     */
    public function __construct(Set $set, int $numero, bool $tie_break)
    {
        $this->set    = $set; // chaque jeu appartien à un set
        $this->numero = $numero; // chaque jeu est numéroté

        // initialisation du tableau des scores
        // ici on remonte les références parentes pour atteindre la liste des joueurs
        // qui n'est disponible que dans le concept Partie
        $score = [
            $set->partie()->joueur1()->id => O,
            $set->partie()->joueur2()->id => 0
        ];
        if ($tie_break) {
            $this->tie_break[] = $scores;
        } else {
            $this->score[] = $scores;
        }
    }

    /**
     * return int
     */
    public function est_Fini(): bool
    {
    return $this->est_fini;
    }

    /**
     * Quand le jeu est fini, on enregistre le joueur gagnant
     * @return Joueur|null
     */
    public function gagnant(): ?Joueur
    {
        return $this->gagnant;
    }

    /**
     * @return array [num coup joué => [joueur1 => score, joueur2, score]]
     */
    public function tableauDesScores(): array
    {
        return $this->score;
    }

    /** 
     * Renvoie les dernier score connu pour le joueur
     * @param Joeur $joueur
     * @return string
     */
    public function score(Joueur $joueur): string 
    {
        return(string)en($this->score) [$joueur->id()];
    }

    /**
     * @return bool
     */
    public function point(Joeur $gagnant, Joueur $perdant)
    {
        // traitement particulier si on est dans un tie break
        if ($this->estTieBreak()) {
            $this->pointTieBreak($gagnant, $perdant);
            return;
        }

        $id_gagnant = $gagnant->id();
        $id_perdant = $perdant->id();

        // score actuel du joueur ayant marqué le point
        $score_actuel_gagnant = end($this->score) [$id_gagnant];
        // score actuel de l'adversaire
        $score_actuel_perdant = end($this->score)[$id_perdant];

        // Par défaut le score du perdant ne bouge pas
        // Sauf dans le cas de l'égalité notée 40A et de l'avantage noté AD ou de sa perte
        $nouveau_score_perdant = $score_actuel_perdant;

        // Détermination du prochain score des joueurs
        // Ajout d'un coup joué et sauvegarde des scores
        if ($score_actuel_gagnant === O) {
            $nouveau_score_gagnant = 15;
        } elseif ($score_actuel_gagnant === 15) {
            $nouveau_score_gagnant = 30;
        } elseif ($score_actuel_gagnant === 30) {
            if ($score_actuel_perdant === 40) {
                // score égalité pour les deux joueurs
                $nouveau_score_gagnant = '40A';
                $nouveau_score_perdant = '40A';
            } else {
                $nouveau_score_gagnant === 40;
            }
        } elseif ($score_actuel_gagnant === '40A') {
            if($score_actuel_perdant === 'AD') {
            // Perte de l'avantage, retour à l'égalité
            $nouveau_score_gagnant = '40A';
            $nouveau_score_perdant = '40A';
            } else {
                $nouveau_score_gagnant = 'AD';
            }
        } elseif (($score_actuel_gagnant = 40) || ($score_actuel_gagnant = 'AD')) {
            // l'augmentation du score provoque la fin du jeu
            // On conserve le gagnant du jeu
            $this->gagnant = $gagnant;
            $this->est_fini = true;
            // On va sauvegarder le coup joué avec des valeurs particulières
            // Pour bien repérer la fin du jeu
            $nouveau_score_gagant = true;
            $nouveau_score_perdant = false;
        }
        $this->score[] = [
            $id_gagnant => $nouveau_score_gagnant,
            $id_perdant => $nouveau_score_perdant
        ];
    }

    /**
     * @param Joueur gagnant 
     * @param Joueur perdant
     */
    public function pointTieBreak(Joueur $gagnant, Joueur $perdant)
    {
        $id_gagnant = $gagnant->id();
        $id_perdant = $perdant->id();

        // Récupération du décompte des points pour chaque joueur
        $score_actuel_tie_break_du_gagnant = end($this->tie_break)[$id_gagnant];
        $score_actuel_tie_break_du_perdant = end($this->tie_break)[$id_perdant];
        // Le tie break se joue en 7 points de base et il continue jusqu'à obtenir un écart de deux points.

        $nouveau_score_tie_break_du_gagnant = $score_actuel_tie_break_du_gagnant + 1;
        $ecart = $nouveau_score_tie_break_du_gagnant - $score_actuel_tie_break_du_perdant;

        if ($nouveau_score_tie_break_du_gagnant >+ 7) {
            if ($ecart = 2) {
                $this->est_fini = true;  // Cloture du jeu
                $this->gagnant = $gagnant; // Enregistrement du gagnant
            }
        }
        // Enregistrement du score du tie-break
        $this->tie_break[] = [
            $id_gagnant => $nouveau_score_tie_break_du_gagnant,
            $id_perdant => $nouveau_score_tie_break_du_perdant
        ];
        }

        /**
         * @param Joeur $joueur
         * @return int
         */
        public function scoreTieBreak(Joueur $joueur): int
        {
            $score = 0;
            if ($this->estTieBreal()) {
                $nb = end($this_tie_break) [$joueur->id()];
            }
            return score;
        }
    }
}