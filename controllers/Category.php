<?php

namespace controllers;

class Category extends \controllers\Controller
{

    protected $modelName = "Category";


    function addCategory()
    {
        $manager =  $this->modelManager;


        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);
       

        if (!$nom ) {
            $this->redirectWithError(
                "index.php?controller=Category&action=ajouter",
                "Veuillez remplir tous les champs du formulaire "
            );
        }

        $manager =  $this->modelManager;
        $user = $manager->getByPseudo($nom);

        // Si une categorie existe avec ce nom, alors on affiche une erreur
        if ($user) {
            $this->redirectWithError(
                "index.php?controller=Category&action=ajouter",
                "Cette catégorie existe déjà"
            );
        }

    }

    function modifier()
    {
        if (!\models\Session::isAdmin()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez être administrateur pour modifier une catégorie"
            );
        }



        $Id_user = filter_input(INPUT_GET, 'Id_user', FILTER_VALIDATE_INT);
        if (!$Id_user) {
            $this->redirectWithError(
                "index.php?controller=Category&action=liste",
                "Vous devez préciser un id"
            );
        }
        $manager =  $this->modelManager;
        $user = $manager->get($Id_user);
        if (!$user) {
            $this->redirectWithError(
                "index.php?controller=Category&action=liste",
                "Vous essayez de modifier une catégorie qui n'existe pas"
            );
        }

        \models\Renderer::render("updateCategory", compact('category'));
    }

    function ajouter()
    {
        \models\Renderer::render("addCategory");
    }

    function updateCategory()
    {
        if (!\models\Session::isAdmin()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez être administrateur pour modifier une catégorie"
            );
        }


        $id= filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $nom = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
      

        if (!$id || !$nom ) {
            $this->redirectWithError(
                "index.php?controller=Category&action=liste",
                "Veuillez remplir tous les champs du formulaire correctement"
            );
        }

        $token =  filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!$token || $token != $_SESSION['token']) {
            $this->redirectWithError(
                "index.php",
                "Vous devez avoir un jeton valide  pour modifier une catégorie"
            );
        }

        $manager = $this->modelManager;
        $category = new \models\Category([
            'id' => $id,
            'nom' =>$nom
           
        ]);

        $manager->update($category);
        $manager = new $this->modelManager;
        $this->redirectWithSuccess(
            "index.php?controller=Category&action=liste",
            "Catégorie modifiée avec succès"
        );
    }

    function liste()
    {
        if (!\models\Session::isAdmin()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez être administrateur pour afficher la liste des catégories"
            );
        }
        $manager = $this->modelManager;
        $users = $manager->getList();
        \models\Renderer::render("listCategory", compact('categories'));
    }

}
