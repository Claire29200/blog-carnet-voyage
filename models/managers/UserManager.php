<?php

namespace models\managers;

class UserManager extends \models\Database
{

  protected $db; // Instance de PDO

  public function __construct()
  {
    $db = $this->dbConnect();
    $this->setDb($db);
  }

  public function setDb(\PDO $db)
  {
    $this->db = $db;
  }

  public function count()
  {
    $query = $this->db->prepare('SELECT COUNT(*) FROM user');
    $query->execute();
    $count = $query->fetchColumn();
    return $count;
  }

  public function add(\models\User $user)
  {
    $query = $this->db->prepare('INSERT INTO user(lastName, firstName,pseudo, email,  pswd, userRole)
        VALUES(:lastName, :firstName,:pseudo, :email,  :pswd, :userRole)');
    $query->bindValue(':lastName', $user->getLastName());
    $query->bindValue(':firstName', $user->getFirstName());
    $query->bindValue(':pseudo', $user->getPseudo());
    $query->bindValue(':email', $user->getEmail());
    $query->bindValue(':pswd', $user->getPswd());
    $query->bindValue(':userRole', $user->getUserRole());
    $query->execute();
  }

  public function get($userId)
  {
    $userId = (int) $userId;
    $query = $this->db->prepare('SELECT id, lastName, firstName,  pseudo, email, pswd, userRole FROM user WHERE id = ' . $userId);
    $query->execute();
    if ($query->rowCount() != 1) {
      return false;
    } else {
      $data = $query->fetch(\PDO::FETCH_ASSOC);
      return new \models\User($data);
    }
  }

  public function getPseudo($userId)
  {
    $userId = (int) $userId;
    $query = $this->db->prepare('SELECT pseudo FROM user WHERE id = ' . $userId);
    $query->execute();
    $data = $query->fetch(\PDO::FETCH_ASSOC);
    //Permet d'obtenir le resultat en chaine de caratère et non en tableau 
    return implode($data);
  }

  public function getList()
  {


    $query = $this->db->prepare('SELECT id, lastName, firstName, pseudo, email,  pswd, userRole FROM user');
    $query->execute();

    $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\models\User');

    $users = $query->fetchAll();
    return $users;
  }

  public function update(\models\User $user)
  {
    $query = $this->db->prepare('UPDATE user SET lastName = :lastName, firstName = :firstName,   pseudo = :pseudo,
                                               userRole = :userRole WHERE userId = :userId');
    $query->bindValue(':lastName', $user->getLastName());
    $query->bindValue(':firstName', $user->getFirstName());
    $query->bindValue(':pseudo', $user->getPseudo());
    $query->bindValue(':userRole', $user->getUserRole());
    $query->bindValue(':userId', $user->getId());
    $query->execute();
  }

  public function getByEmail($email)
  {
    $query = $this->db->prepare('SELECT * FROM user WHERE email = :email');
    $query->execute([':email' => $email]);
    return $query->fetch(\PDO::FETCH_ASSOC);
  }

  public function getByPseudo($pseudo)
  {
    $query = $this->db->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
    $query->execute([':pseudo' => $pseudo]);
    return $query->fetch(\PDO::FETCH_ASSOC);
  }
}
