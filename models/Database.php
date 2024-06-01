<?php

namespace models;

class Database{

  protected function dbConnect()
      {
          $db = new \PDO('mysql:host=localhost;dbname=blog-master;charset=utf8', 'root', '0000');
          $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
          return $db;
      }
}
