<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="assets/img/favicon.png" type="image/png">
    <title>Mon blog carnet de voyage, mon projet de fin de formation pour valider mon titre de développeuse Web Web mobile au sein de l'AFPA</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/animate-css/animate.css">
    <!-- main css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>
    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.php"><img src="assets/img/logo.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                            <li class="nav-item"><a class="nav-link" href="https://claire29200.my.canva.site/" target="_blank">Mon Portfolio</a></li>
                           
                            <?php if (\models\Session::isAdmin()) { ?>
                                <li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrateur</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="index.php?controller=Post&action=ajouter">Ajouter un article </a></li>
                                        <li class="nav-item"><a class="nav-link" href="index.php?controller=Post&action=liste">Liste des articles</a></li>
                                        <li class="nav-item"><a class="nav-link" href="index.php?controller=User&action=liste">Liste utilisateurs</a></li>
                                        <li class="nav-item"><a class="nav-link" href="index.php?controller=Comment&action=liste">Commentaires</a></li>                                        
                                    </ul>
                                    <?php } ?>
                       
                    </div>
                                
                           
                      
                    
                    <div class="right-button">
                        <ul>
                            <?php if (!\models\Session::isConnected()) { ?>
                                <li class="login"><a class="login" href="index.php?controller=User&action=formLogin">Se connecter</a></li>
                            <?php }
                            if (\models\Session::isConnected()) { ?>
                                <li class="login"><a class="login" href="index.php?controller=User&action=logout">Déconnexion</a></li>
                            <?php } ?>
                            <?php if (!\models\Session::isConnected()) { ?>
                            <li><a class="sign_up" href="index.php?controller=User&action=ajouter">Créer votre compte</a></li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
                </div>
            </nav>
        </div>
        <?php if (\models\Session::showFlashes('error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?php foreach (\models\Session::getFlashes('error') as $message) : ?>
                    <p><?= $message ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>
        <?php if (\models\Session::showFlashes('success')) : ?>
            <div class="alert alert-success">
                <?php foreach (\models\Session::getFlashes('success') as $message) : ?>
                    <p><?= $message ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </header>

</body>