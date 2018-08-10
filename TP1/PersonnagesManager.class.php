<?php

class PersonnagesManager
{
    private $db; // Instance de PDO

    /**
     * PersonnagesManager constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->setDb($db);
    }

    /**
     * @param Personnage $perso
     */
    public function add(Personnage $perso)
    {
        $q = $this->db->prepare('INSERT INTO personnagestp1(nom) VALUES(:nom)');
        $q->bindValue(':nom', $perso->getNom());
        $q->execute();

        $perso->hydrate([
            'id' => $this->db->lastInsertId(),
            'degats' => 0,
            'lvl' => 0,
            'exp' => 0,
        ]);
    }

    /**
     * @return mixed
     */
    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM personnagestp1')->fetchColumn();
    }

    /**
     * @param Personnage $perso
     */
    public function delete(Personnage $perso)
    {
        $this->db->exec('DELETE FROM personnagestp1 WHERE id = ' . $perso->getId());
    }

    /**
     * @param $info
     * @return bool
     */
    public function exists($info)
    {
        if (is_int($info)) // On veut voir si tel personnage ayant pour id $info existe.
        {
            return (bool)$this->db->query('SELECT COUNT(*) FROM personnagestp1 WHERE id = ' . $info)->fetchColumn();
        }

        // Sinon, c'est qu'on veut vérifier que le nom existe ou pas.

        $q = $this->db->prepare('SELECT COUNT(*) FROM personnagestp1 WHERE nom = :nom');
        $q->execute([':nom' => $info]);

        return (bool)$q->fetchColumn();
    }

    /**
     * @param $info
     * @return Personnage
     */
    public function get($info)
    {
        if (is_int($info)) {
            $q = $this->db->query('SELECT id, nom, degats, lvl, exp FROM personnagestp1 WHERE id = ' . $info);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            return new Personnage($donnees);
        } else {
            $q = $this->db->prepare('SELECT id, nom, degats, lvl, exp FROM personnagestp1 WHERE nom = :nom');
            $q->execute([':nom' => $info]);
            return new Personnage($q->fetch(PDO::FETCH_ASSOC));
        }
    }

    /**
     * @param $nom
     * @return array
     */
    public function getList($nom)
    {
        $persos = [];

        $q = $this->db->prepare('SELECT id, nom, degats, lvl, exp FROM personnagestp1 WHERE nom <> :nom ORDER BY nom');
        $q->execute([':nom' => $nom]);

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $persos[] = new Personnage($donnees);
        }

        return $persos;
    }

    /**
     * @param $nom
     * @return array
     */
    public function getAll()
    {
        $persos = [];
        $q = $this->db->prepare('SELECT id, nom, degats, lvl, exp FROM personnagestp1 ORDER BY nom');
        $q->execute();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $persos[] = new Personnage($donnees);
        }

        return $persos;
    }



    /**
     * @param Personnage $perso
     */
    public function update(Personnage $perso)
    {

        $query = 'UPDATE personnagestp1 SET degats = :degats, lvl = :lvl, exp = :exp WHERE id = :id';
        $q = $this->db->prepare($query);

        $q->bindValue(':degats', $perso->getDegats(), PDO::PARAM_INT);
        $q->bindValue(':lvl', $perso->getLvl(), PDO::PARAM_INT);
        $q->bindValue(':exp', $perso->getExp(), PDO::PARAM_INT);
        $q->bindValue(':id', $perso->getId(), PDO::PARAM_INT);

        $q->execute();
    }

    /**
     * @param PDO $db
     */
    public function setDb(PDO $db)
    {
        $this->db = $db;
    }
}