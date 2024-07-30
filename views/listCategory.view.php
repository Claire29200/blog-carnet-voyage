<section class="hero-banner d-flex align-items-center">
    <div class="container text-center">
        <h2>Liste des catégories</h2>
    </div>
</section>
<section class="latest-blog-area area-padding">
    <div class="container">
        <div class="section-top-border">
            <div class="progress-table-wrap">
                <div class="progress-table">
                    <div class="table-head">
                        <div class="serial">id</div>
                        <div class="serial">Nom</div>
                        <div class="serial">Modifier</div>
                        <div class="serial">Supprimer</div>
                    </div>
                    <?php
                    foreach ($categories as $value) {
                    ?>
                        <div class="table-row">
                            <div class="serial"><?= $value->getId(); ?></div>
                            <div class="serial"><?= $value->getNom(); ?></div>
                            <div class="serial"><a href="index.php?controller=Category&action=modifier&id=<?= $value->getId(); ?>">Modifier</a></div>
                            <div class="serial"><a href="index.php?controller=Category&action=supprimer&id=<?= $value->getId(); ?>">Supprimer</a></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>