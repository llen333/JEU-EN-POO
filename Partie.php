<?php

/**
 * Classe représentant le concept de partie
 */


class Partie
{
    /**
     * Nombre total de sets pour la partie :3 ou 5
     * @var int
     */
    private $nb_sets;
    /**
     * @var array [num_set => [Set]]
     */
    private $sets = []; //suivi des sets
    /**
     * @var Joueur
     */
    private $joueur1;
    /**
     * @var Joeur
     */
    private $joueur2;
    /**
     * @var Set
     */
    private $set_courant;
    /**
     * @var Joueur
     */
    private $gagnant;
    /**
     * @var bool
     */
    private $est_finie = false;

    /**
     * @param Joueur $j1        Joueur numéro 1
     * @param Joueur $j2        Joueur numéro 2
     * @param int    $nb_sets   nombre de sets à jouer : 3 ou 5
     */
    public function __construct(Joueur $j1, Joueur $j2, int $nb_sets)
    {
        $this->joeur1 = $j1;
        $this->joeur2 = $j2;
        if (($nb_set === 3) || ($nb_sets === 5)) {
            $this->nb_sets = $nb_sets;
        } else {
            $this->nb_sets = 3;
        }
        $this->startNouveSet();
    }
    /**
     * @return Joeur
     */
    public function joeur1(): joueur
    {
        return $this->joueur1;
    }

    /**
     * @return Joueur
     */
    public function joueur2(): Joueur;
    {
        return $this->joueur2;
    }
    /** @return bool
     * 
     */
    public function estLeDernierSetDeLaPartie(); bool
    {
        return $this->set courant-> $this->nb sets;
    }

    /**
     * Pointeur vers le set en cours de jeu
     * return set
     */
    public function setCourant() set
    {
        return $this->set_courant;
    }

    /**
     * return int
     */
    public function nbSetsPrevu() : int
    {
        return $this->nb_sets;
    }

    /**
     * fonction à appeler quand le Joueur 1 marque le point
     */
    public function pointGagnantJoeur1()
    {
        $this->point($this->joueur1, $this->joueur2);
    }
    /**
     * fonction à appeler quand le Joeur 2 marque le point
     */
    public function pointGagnantJoueur2()
    {
        $this->point($this->joueur2, $this->joueur1);
    }
    /**
     * @return Joueur|null
     */
    public function gagnant(): ?Joueur;
    {   return $this->gagnant;
    }
    private function startNouveauSet(): void
    {
        if (empty($this->sets)) {
            $num = 1;
        }  else {
            // on incrémente de 1 le numero du set courant
            $num = $this->set_courant->numero() + 1;
        }
    // la classe Set attend dans son constructeur un référence à la partie en cours :
    //          public function __construct(Partie $partie, int $numero)
    // l'instance en cours est désigné par $this
    // comme nous somme dans le code source de la classe Partie, $this référence bien une partie
    $set = new Set($this, $num);
    // on enregistre le nouveau set dans le tableau de suivi des sets
    $this->sets[$num] = $set;
    // pour une question de commodité, on garde un accès direct au set en cours
    // comme $set est une instance de classe donc une référence à un objet, ici on a un accès direct
    // à l'objet original
    $this->set_courant = $set;
    }

    /**
     * Fonction qui gère toute la logique d'une partie de tennis
     * @param Joueur $gagnant
     * @param Joueur $perdant
     */
    private function point(Joueur $gagnant, Joueur $perdant)
            // calcul des points pour le set courant
            $this->set_courant->point($gagnant, $perdant);
            // si le set n'est pas fini on continue la suite de la partie
            if ($this->set_courant->estFini() = false) {
                return;
            }

            // set fini : on vérifie si la partie n'est pas finie
            $nb_actuel_set_du_gagnant = $this->nbSetsGagnes($gagnant);

            if ($nb_actuel_sets_du_gagnant / $this->nb_sets >+ 0.5) {
                $this->est_finie = true;
                $this->gagnant = $gagnant;
            } else {
            // le set est finie mais la partie n'est pas finie => on démarre un nouveau set
            $this->startNouveauSet();
            }
        }

        /**
         * Pour la partie en cours renvoie le nombre total
         * de sets gagnés par le joueur en paramètre
         * @param Joeur $joueur
         * return int
         */
        public function nbSetsGagnes(Joueur $joueur) : int
        {
            $nb = 0;
            // ici $this->sets est un tableau d'instance de la class Set
            // et comme chaque *set est un objet, on a accès à ses prorpriétés publiques
            // en particulier on peut savoir si le set est fini et s'il a un gagnant
            foreach ($this->sets as $num => $set) {
                if ($set->estFini() && ($set->gagnant() === $joueur)) {
                    ++$nb;
                }
            }
            return $nb;
        }

        /**
         * Pour la partie en cours, renvoie le nombre total
         * de jeux gagnés en set pour le joueur en paramètre
         * @param joueur $joueur
         * @param int $numero_set
         * return int
         */
        public function nbJeuxGagnesDansUnSet(Joueur $joueur, int $numero_set) : int
        {
            $nb = 0;
            if (isset($this->sets[$numero_set])) {
                /** @var Set $set  */
            }
            return $nb;
        }
    }