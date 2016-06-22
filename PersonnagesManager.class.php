<?php
class PersonnagesManager
{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }


    public function add(Personnage $perso)
    {


        $donnees = [
            'nom' => 'Vyk12',
            'forcePerso' => 5,
            'degats' => 55,
            'niveau' => 4,
            'experience' => 20

        ];





        $q =   $this->_db->prepare('INSERT INTO personnages(nom, forcePerso, degats, niveau, experience) VALUES(:nom, :forcePerso, :degats, :niveau, :experience)');
        $q->bindValue(':nom', $perso->nom(), PDO::PARAM_STR);
        $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
        $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
        $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
        $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);


        try {
            $q->execute();
        }
        catch (PDOException $e)
        {
            die('Erreur : boulette ' . $e->getMessage());
        }


    }


    public function delete(Personnage $perso)
    {
        $this->_db->exec('DELETE FROM personnages WHERE id = '.$perso->id());
    }


    public function get($id)
    {
        $id = (int) $id;
        $q = $this->_db->query('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnages WHERE id = '.$id);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new Personnage($donnees);
    }


    public function getList()
    {
        $persos = [];
        $q = $this->_db->query('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnages ORDER BY nom');
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $persos[] = new Personnage($donnees);
        }
        return $persos;
    }


    public function update(Personnage $perso)
    {

        $q = $this->_db->prepare('UPDATE personnages SET forcePerso = :forcePerso, degats = :degats, niveau = :niveau, experience = :experience WHERE id = :id');

        $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
        $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
        $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
        $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
        $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);

        $q->execute();
    }


    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }



}