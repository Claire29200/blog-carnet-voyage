<section class="home_banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-6 col-xl-5 offset-xl-7">
                    <div class="banner_content">
                        <h3>Claire Simonot<br> Développeuse Web</h3>
                        <p>Ce site web est mon projet de fin de formation. <br>Ce sera un blog carnet de voyage.<br> Merci de visiter mon site!</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--================ Start Blog Area =================-->
<section class="latest-blog-area area-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="area-heading">
                    <h4>Les articles de mon blog</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            foreach ($posts as $value) {
            ?>
                <div class="col-lg-4 col-md-6 ">
                    <a href="index.php?controller=Post&action=afficher&id=<?= $value->getId(); ?>">
                        <div class="single-blog">
                            <div class="thumb">
                                <img class="img-fluid w-100" src="<?= $value->getImage() ?>" alt="image_article">
                            </div>
                            <div class="single-blog-content">

                                <h3>
                                    <?= ucfirst($value->getTitle()); ?>
                                </h3>
                                <h4> Catégorie:<?= ucfirst($value->getCategoryId()); ?> </h4>
                                <p class="date"> <?= ucfirst($value->getSlug()); ?></p>
                    </a>
                    <p class="date">
                        <i>Dernière mise à jour le : <?= $value->getModificationDate(); ?> </i>
                    </p>
                </div>
        </div>
    </div>
<?php } ?>
</div>
</div>
</section>
<!--================ End Blog Area =================-->