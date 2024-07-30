<section class="hero-banner d-flex align-items-center">
  <div class="container text-center">
    <h2>Article</h2>
  </div>
</section>

<!--================Blog Area =================-->
<section class="blog_area single-post-area area-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 posts-list">
        <div class="single-post">
          <div class="feature-img">
          <a><img src="<?= $post->getImage() ?>"
                    width='80%'></a>
          </div>
          <div class="blog_details">
            <h2><?= $post->getTitle(); ?></h2>
            <h4><?= $post->getNom(); ?></h4>
            <p class="date"></p>
            <p class="excert">
              <?= $post->getSlug(); ?>
            </p>

            <p class="excert">
              <?= $post->getContent(); ?>
            </p>
            <div class="d-flex align-items-center">



              <p class="date">Dernière modification le : <?= $post->getModificationDate(); ?></p>

            </div>
            <p class="date">Ecrit par : <?= $post->getAuthor(); ?></p>
          </div>
        </div>
        <hr>
        <div class="comment-form">
          <h4>Laissez un commentaire</h4>
          <form class="form-contact comment_form" method="post" action="index.php?controller=Comment&action=addComment" id="commentForm">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <textarea class="form-control w-100" name="content" cols="30" rows="9" placeholder="Ecrire un commentaire"></textarea>
                </div>
              </div>

              <input class="form-control" type="hidden" name="postId" value="<?= $post->getId(); ?>">
              <?php if (\models\Session::isConnected()) { ?>   
              <input class="form-control" type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
               <?php } ?>
            </div>
            <div class="form-group">
              <button type="submit" class="button button-contactForm">Poster le commentaire</button>
            </div>
          </form>
        </div>
        <div class="comments-area">
          <h4><?= count($comments) ?> Commentaires</h4>
          <?php foreach ($comments as $values) { ?>
            <div class="comment-list">
              <div class="single-comment justify-content-between d-flex">
                <div class="user justify-content-between d-flex">
                  <div class="desc">
                    <p class="comment">
                      <?= $values->getContent(); ?>
                    </p>

                    <div class="d-flex justify-content-between">
                      <div class="d-flex align-items-center">
                        <h5>
                          Ecrit Par <?= $values->getAuthor(); ?>
                        </h5>
                        <p class="date">le <?= $values->getCreationDate(); ?></p>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        
      </div>
    </div>
  </div>
</section>