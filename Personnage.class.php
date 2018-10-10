<?php

class Personnage

{


    private $_force;
    private $_localisation;
    private $_experience;
    private $_degats;

    const FORCE_PETITE = 20;
    const FORCE_MOYENNE = 50;
    const FORCE_GRANDE = 80;

    private static $_texteADire = 'Je vais tous vous tuer !';
    private static $_compteur = 0;


// Constructeur

    public function __construct($donnees) // Constructeur demandant 2 paramètres
    {

        $this-> hydrate($donnees);
        self::$_compteur ++ ;

    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }


    public static function combatants()
    {
        echo 'nb combattant :'.self::$_compteur. '<br>';
    }





//Action

    public static function parler()
    {
        echo self::$_texteADire;
    }

    public function afficherExperience()
    {
        echo 'j ai '.$this->_experience . ' exp  <br>';
    }

    public function deplacer() // Une méthode qui déplacera le personnage (modifiera sa localisation).
    {

    }

    public function frapper(Personnage $persoAFrapper)
    {
        $persoAFrapper->_degats += $this->forcePerso;
    }

    public function gagnerExperience() // Une méthode augmentant l'attribut $experience du personnage.
    {
        $this->_experience++;
        $this->afficherExperience();
    }




// Accesseur

    public function id() { return (int)$this->_id; }
    public function nom() { return $this->_nom; }
    public function forcePerso() { return (int)$this->_forcePerso; }
    public function degats() { return (int)$this->_degats; }
    public function niveau() { return (int)$this->_niveau; }
    public function experience() { return (int)$this->_experience; }






// Mutateur

    public function setId($id)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int) $id;
        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0)
        {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->_id = $id;
        }
    }

    public function setNom($nom)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($nom))
        {
            $this->_nom = $nom;
        }
    }

    public function setForcePerso($forcePerso)
    {
        $forcePerso = (int) $forcePerso;
        if ($forcePerso >= 1 && $forcePerso <= 100)
        {
            $this->_forcePerso = $forcePerso;
        }
    }

    public function setDegats($degats)
    {
        $degats = (int) $degats;
        if ($degats >= 0 && $degats <= 100)
        {
            $this->_degats = $degats;
        }
    }

    public function setNiveau($niveau)
    {
        $niveau = (int) $niveau;
        if ($niveau >= 1 && $niveau <= 100)
        {
            $this->_niveau = $niveau;
        }
    }

    public function setExperience($experience)
    {
        $experience = (int) $experience;
        if ($experience >= 1 && $experience <= 100)
        {
            $this->_experience = $experience;
        }
    }





















}