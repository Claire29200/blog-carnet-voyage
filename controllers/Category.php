<?php

namespace controllers;

class Category extends \controllers\Controller
{

    protected $modelName = "Category";


    function addCategory()
    {
        $manager =  $this->modelManager;


        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);


        if (!$nom) {
            $this->redirectWithError(
                "index.php?controller=Category&action=ajouter",
                "Veuillez remplir tous les champs du formulaire "
            );
        }

        $manager =  $this->modelManager;
        $category = $manager->getIdByNom($nom);

        // Si une categorie existe avec ce nom, alors on affiche une erreur
        if ($category) {
            $this->redirectWithError(
                "index.php?controller=Category&action=ajouter",
                "Cette catégorie existe déjà"
            );
        }

        $category = new \models\Category([
            'nom' => $nom
        ]);

        $manager->add($category);
        $this->redirectWithSuccess(
            "index.php?controller=Category&action=liste",
            "Catégorie ajoutée avec succès"
        );
    }

    function modifier()
    {
        if (!\models\Session::isAdmin()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez être administrateur pour modifier une catégorie"
            );
        }



        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            $this->redirectWithError(
                "index.php?controller=Category&action=liste",
                "Vous devez préciser un id"
            );
        }
        $manager =  $this->modelManager;
        $category = $manager->get($id);
        if (!$category) {
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


        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_SPECIAL_CHARS);


        if (!$id || !$nom) {
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
            'nom' => $nom

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
        $categories = $manager->getList();

        \models\Renderer::render("listCategory", compact('categories'));
    }

    function supprimer()
    {
        if (!\models\Session::isAdmin()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez être administrateur pour supprimer une catégorie"
            );
        }
        $manager = $this->modelManager;
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            $this->redirectWithError(
                "index.php?controller=Category&action=liste",
                "Vous devez préciser un id !"
            );
        }

        $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$token || $token != $_SESSION['token']) {
            $this->redirectWithError(
                "index.php",
                "Vous devez avoir un jeton valide  pour supprimer une catégorie"
            );
        }

        $post = $manager->delete($id);
        if (!$post) {
            $this->redirectWithError(
                "index.php?controller=Category&action=liste",
                "Vous essayez de supprimer une catégorie qui n'existe pas"
            );
        }
        $this->redirectWithSuccess(
            "index.php?controller=Category&action=liste",
            "Catégorie supprimée avec succès"
        );
    }
}
