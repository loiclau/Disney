<?php
class PersonnagesManagerTp1
{
    private $_db; // Instance de PDO

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(PersonnageTp1 $perso)
    {
        $q = $this->_db->prepare('INSERT INTO personnagestp1(nom) VALUES(:nom)');
        $q->bindValue(':nom', $perso->nom());
        $q->execute();

        $perso->hydrate([
            'id' => $this->_db->lastInsertId(),
            'degats' => 0,
        ]);
    }

    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM personnagestp1')->fetchColumn();
    }

    public function delete(PersonnageTp1 $perso)
    {
        $this->_db->exec('DELETE FROM personnagestp1 WHERE id = '.$perso->id());
    }

    public function exists($info)
    {
        if (is_int($info)) // On veut voir si tel personnage ayant pour id $info existe.
        {
            return (bool) $this->_db->query('SELECT COUNT(*) FROM personnagestp1 WHERE id = '.$info)->fetchColumn();
        }

        // Sinon, c'est qu'on veut vérifier que le nom existe ou pas.

        $q = $this->_db->prepare('SELECT COUNT(*) FROM personnagestp1 WHERE nom = :nom');
        $q->execute([':nom' => $info]);

        return (bool) $q->fetchColumn();
    }

    public function get($info)
    {
        if (is_int($info))
        {
            $q = $this->_db->query('SELECT id, nom, degats FROM personnagestp1 WHERE id = '.$info);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);

            return new PersonnageTp1($donnees);
        }
        else
        {
            $q = $this->_db->prepare('SELECT id, nom, degats FROM personnagestp1 WHERE nom = :nom');
            $q->execute([':nom' => $info]);

            return new PersonnageTp1($q->fetch(PDO::FETCH_ASSOC));
        }
    }

    public function getList($nom)
    {
        $persos = [];

        $q = $this->_db->prepare('SELECT id, nom, degats FROM personnagestp1 WHERE nom <> :nom ORDER BY nom');
        $q->execute([':nom' => $nom]);

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $persos[] = new PersonnageTp1($donnees);
        }

        return $persos;
    }

    public function update(PersonnageTp1 $perso)
    {
        $q = $this->_db->prepare('UPDATE personnagestp1 SET degats = :degats WHERE id = :id');

        $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
        $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);

        $q->execute();
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}