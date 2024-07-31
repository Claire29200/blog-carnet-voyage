<?php

namespace models\managers;

class PostManager extends \models\Database
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
    $query = $this->db->prepare('SELECT COUNT(*) FROM post');
    $query->execute();
    $count = $query->fetchColumn();
    return $count;
  }

  public function add(\models\Post $post)
  {
    $query = $this->db->prepare('INSERT INTO post(title, image, slug, content, author, creationDate, userId, categoryId)
    VALUES(:title, :image, :slug, :content, :author, :creationDate, :userId, :categoryId)');
    $query->bindValue(':title', $post->getTitle());
    $query->bindValue(':image', $post->getImage());
    $query->bindValue(':slug', $post->getSlug());
    $query->bindValue(':content', $post->getContent());
    $query->bindValue(':author', $post->getAuthor());
    $query->bindValue(':creationDate', $post->getCreationDate());
    $query->bindValue(':userId', $post->getUserId());
    $query->bindValue(':categoryId', $post->getCategoryId());
    $query->execute();
  }

  public function delete($id)
  {
    $query = $this->db->prepare('DELETE FROM post WHERE id = ' . $id);
    $query->execute();
    if ($query->rowCount() != 1) {
      return false;
    } else {
      return true;
    }
  }

  public function get($id)
  {
    $id = (int) $id;
    $query = $this->db->prepare('SELECT id, image, title, slug, content, author, date_format(creationDate,"%d/%m/%Y") AS creationDate, 
                                    date_format(modificationDate,"%d/%m/%Y") AS modificationDate, userId, categoryId FROM post WHERE id = ' . $id);
    $query->execute();
    if ($query->rowCount() != 1) {
      return false;
    } else {

      $donnees = $query->fetch(\PDO::FETCH_ASSOC);
      return new \models\Post($donnees);
    }
  }

  public function getPostTitle($postid)
  {

    $query = $this->db->prepare('SELECT title FROM post WHERE id = ' . $postid);
    $query->execute();

    $data = $query->fetch(\PDO::FETCH_ASSOC);

    //Permet d'obtenir le resultat en chaine de caratère et non en tableau 
    return implode($data);
  }

  public function getList()
  {


    $query = $this->db->prepare('SELECT id, title, image, slug, content, date_format(creationDate,"%d/%m/%Y") AS creationDate,
                                   date_format(modificationDate,"%d/%m/%Y") AS modificationDate, userId , categoryId FROM post');
    $query->execute();
    $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\models\Post');

    $posts = $query->fetchAll();


    return $posts;
  }

  public function getPublishedList()
  {

    $query = $this->db->prepare('SELECT id, title, image, slug, content, author, date_format(creationDate,"%d/%m/%Y") AS creationDate,
                                     date_format(modificationDate,"%d/%m/%Y") AS modificationDate, userId , categoryId FROM post ORDER BY id DESC');
    $query->execute();
    $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\models\Post');

    $posts = $query->fetchAll();

    return $posts;
  }

  public function update(\models\Post $post)
  {
    $query = $this->db->prepare('UPDATE post SET title = :title, image = :image, slug = :slug, content = :content, author = :author,  
                                                 modificationDate = :modificationDate,  userId = :userId,  categoryId = :categoryId  WHERE id = :id');
    $query->bindValue(':title', $post->getTitle());
    $query->bindValue(':image', $post->getImage());
    $query->bindValue(':slug', $post->getSlug());
    $query->bindValue(':content', $post->getContent());
    $query->bindValue(':author', $post->getAuthor());
    $query->bindValue(':modificationDate', $post->getModificationDate());
    $query->bindValue(':userId', $post->getUserId());
    $query->bindValue(':categoryId', $post->getCategoryId());
    $query->bindValue(':id', $post->getId());
    $query->execute();
  }
}
