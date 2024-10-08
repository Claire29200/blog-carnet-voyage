<?php

namespace models\managers;

class CategoryManager extends \models\Database
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
    $query = $this->db->prepare('SELECT COUNT(*) FROM category');
    $query->execute();
    $count = $query->fetchColumn();
    return $count;
  }


  public function delete($id)
  {
    $query = $this->db->prepare('DELETE FROM category WHERE id = ' . $id);
    $query->execute();
    if ($query->rowCount() != 1) {
      return false;
    } else {
      return true;
    }
  }

  public function add(\models\Category $category)
  {
    $query = $this->db->prepare('INSERT INTO category(nom)
        VALUES(:nom)');
    $query->bindValue(':nom', $category->getNom());
    $query->execute();
  }

  public function get($categoryId)
  {
    $categoryId = (int) $categoryId;
    $query = $this->db->prepare('SELECT id, nom FROM category WHERE id = ' . $categoryId);
    $query->execute();
    if ($query->rowCount() != 1) {
      return false;
    } else {
      $data = $query->fetch(\PDO::FETCH_ASSOC);
      return new \models\Category($data);
    }
  }

  public function getNom($categoryId)
  {
    $categoryId = (int) $categoryId;
    $query = $this->db->prepare('SELECT nom FROM category WHERE id = ' . $categoryId);
    $query->execute();
    $data = $query->fetch(\PDO::FETCH_ASSOC);
    //Permet d'obtenir le resultat en chaine de caratère et non en tableau 
    return implode($data);
  }

  public function getIdByNom($nom)
  {
    $query = $this->db->prepare('SELECT id FROM category WHERE nom = :nom');
    $query->execute([':nom' => $nom]);
    $data = $query->fetch(\PDO::FETCH_ASSOC);
    //Permet d'obtenir le resultat en chaine de caratère et non en tableau 
    return implode($data);
  }

  public function getList()
  {


    $query = $this->db->prepare('SELECT id, nom FROM category');
    $query->execute();

    $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\models\Category');

    $categories = $query->fetchAll();
    return $categories;
  }

  public function update(\models\Category $category)
  {
    $query = $this->db->prepare('UPDATE category SET nom = :nom  WHERE id = :id');
    $query->bindValue(':nom', $category->getNom());
    $query->bindValue(':id', $category->getId());
    $query->execute();
  }
}
