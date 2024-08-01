<section class="hero-banner d-flex align-items-center">
    <div class="container text-center">
        <h2>Modifier une catégorie</h2>
    </div>
</section>
<section class="contact-section area-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <form class="form-contact contact_form" method="post" action="index.php?controller=Category&action=updateCategory">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" type="hidden" name="id" value="<?= $category->getId(); ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                Titre : <input class="form-control" type="text" name="nom" value="<?= $category->getNom(); ?>">
                            </div>
                        </div>
                        <input class="form-control" type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" class="button button-contactForm" name="modifier" value="Modifier">
                        <input type="button" class="button button-contactForm" value="Retour" onClick="document.location.href = document.referrer" />

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>