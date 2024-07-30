<section class="hero-banner d-flex align-items-center">
    <div class="container text-center">
        <h2>Ajouter une catégorie</h2>
    </div>
</section>
<section class="contact-section area-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <form class="form-contact contact_form" method="post" action="index.php?controller=Category&action=addCategory">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                Nom : <input class="form-control" type="text" name="nom">
                            </div>
                        </div>

                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" class="button button-contactForm" name="ajouter" value="Ajouter">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>