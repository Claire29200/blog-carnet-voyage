<?php

namespace models;

class Category extends Model
{

    protected $nom;
  


    //GETTERS    

    function getNom()
    {
        return $this->nom;
    }

    //SETTERS

    function setId($id)
    {
        $this->id = $id;
    }

    function setNom($nom)
    {
        $this->nom = $nom;
    }

}
