<?php

namespace controllers;

class Post extends \controllers\Controller
{

    protected $modelName = "Post";

    //Affiche la page page d'accueil 
    function accueil()
    {
        $manager = $this->modelManager;
        $posts = $manager->getPublishedList();
        \models\Renderer::render("accueil", compact('posts'));
    }

    //Affiche un article en fonction de l'id recupéré par GET
    function afficher()
    {
        $manager = $this->modelManager;

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            $this->redirectWithError(
                "index.php",
                "Vous devez préciser un id"
            );
        }

        $post = $manager->get($id);

        if (!$post) {
            $this->redirectWithError("index.php", "Vous essayez d'afficher un article qui n'existe pas");
        }


        $postId = $id;

        $commentsModel = new \models\managers\CommentManager();
        $comments = $commentsModel->findAllWithPost($postId);

        \models\Renderer::render("post", compact('post', 'comments'));
    }


    function ajouterPost()
    {
        if (!\models\Session::isAdmin()) {
            $this->redirectWithError(
                "index.php",
                "Il faut être administrateur pour pouvoir ajouter un article"
            );
        }

        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_SPECIAL_CHARS);
        $slug = filter_input(INPUT_POST, 'slug', FILTER_SANITIZE_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
        $author =  filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
        $creationDate = date('Y-m-d');

        $userId = $_SESSION['user']['id'];
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!$title || !$image || !$slug || !$content || !$author) {
            $this->redirectWithError(
                "index.php?controller=Post&action=ajouter",
                "Veuillez remplir tous les champs du formulaire correctement"
            );
        }

        $token =  filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!$token || $token != $_SESSION['token']) {
            $this->redirectWithError(
                "index.php?controller=Post&action=ajouter",
                "Vous devez avoir un jeton valide  pour ajouter un article"
            );
        }

        $manager = $this->modelManager;
        $post = new \models\Post([
            'title' => $title,
            'image' => $image,
            'slug' => $slug,
            'content' => $content,
            'author' => $author,
            'creationDate' => $creationDate,
            'userId' => $userId,
            'categoryId' => $categoryId


        ]);

        $manager->add($post);
        $this->redirectWithSuccess(
            "index.php?controller=Post&action=liste",
            "Article ajouté avec succès"
        );
    }

    function modifier()
    {
        if (!\models\Session::isAdmin()) {
            $this->redirectWithError(
                "index.php",
                "Il faut être administrateur pour modifier un article"
            );
        }
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            $this->redirectWithError(
                "index.php?controller=Post&action=liste",
                "Vous devez préciser un id !"
            );
        }
        $manager = new $this->modelManager;

        $post = $manager->get($id);
        if (!$post) {
            $this->redirectWithError(
                "index.php?Post&action=liste",
                "Vous essayez de modifier un article qui n'existe pas"
            );
        }
        \models\Renderer::render("updatePost", compact('post'));
    }

    function ajouter()
    {
        if (!\models\Session::isAdmin()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez être administrateur pour ajouter un article"
            );
        }
        $categoryManager = new \models\managers\CategoryManager();
        $categories = $categoryManager->getList();

        \models\Renderer::render("addPost", compact('categories'));
    }

    function modifierPost()
    {
        if (!\models\Session::isAdmin()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez être administrateur pour modifier un article"
            );
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_SPECIAL_CHARS);
        $slug = filter_input(INPUT_POST, 'slug', FILTER_SANITIZE_SPECIAL_CHARS);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_SPECIAL_CHARS);
        $author =  filter_input(INPUT_POST, 'author', FILTER_SANITIZE_SPECIAL_CHARS);
        $modificationDate = date('y-m-d');

        $userId = filter_input(INPUT_POST, 'userId', FILTER_VALIDATE_INT);
        $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$id || !$image || !$title || !$slug || !$content || !$author || !$modificationDate || !$userId || !$categoryId) {
            $this->redirectWithError(
                "index.php?Post&action=liste",
                "Veuillez remplir tous les champs du formulaire correctement"
            );
        }

        $token =  filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!$token || $token != $_SESSION['token']) {
            $this->redirectWithError(
                "index.php",
                "Vous devez avoir un jeton valide  pour modifier un article"
            );
        }

        $manager = new $this->modelManager;
        $post = new \models\Post([
            'id' => $id,
            'title' => $title,
            'image' => $image,
            'slug' => $slug,
            'content' => $content,
            'author' => $author,
            'modificationDate' => $modificationDate,
            'userId' => $userId,
            'categoryId' => $categoryId
        ]);

        $manager->update($post);
        $manager = new $this->modelManager;
        $this->redirectWithSuccess(
            "index.php?controller=Post&action=liste",
            "Article modifié avec succès"
        );
    }

    function liste()
    {
        if (!\models\Session::isAdmin()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez être administrateur pour afficher la liste des articles"
            );
        }
        $manager = $this->modelManager;
        $posts = $manager->getList();
        \models\Renderer::render("listPost", compact('posts'));
    }

    function supprimer()
    {
        if (!\models\Session::isAdmin()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez être administrateur pour supprimer un article"
            );
        }
        $manager = $this->modelManager;
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            $this->redirectWithError(
                "index.php?controller=Post&action=liste",
                "Vous devez préciser un id !"
            );
        }

        $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$token || $token != $_SESSION['token']) {
            $this->redirectWithError(
                "index.php",
                "Vous devez avoir un jeton valide  pour supprimer un article"
            );
        }

        $post = $manager->delete($id);
        if (!$post) {
            $this->redirectWithError(
                "index.php?controller=Post&action=liste",
                "Vous essayez de supprimer un article qui n'existe pas"
            );
        }
        $this->redirectWithSuccess(
            "index.php?controller=Post&action=liste",
            "Article supprimé avec succès"
        );
    }
}
