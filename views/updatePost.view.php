<section class="hero-banner d-flex align-items-center">
  <div class="container text-center">
    <h2>Modifier un article</h2>
  </div>
</section>
<section class="contact-section area-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <form class="form-contact contact_form" method="post" action="index.php?controller=Post&action=modifierPost">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <input class="form-control" type="hidden" name="id" value="<?= $post->getId(); ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                Titre : <input class="form-control" type="text" name="title" value="<?= $post->getTitle(); ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                Image : <input class="form-control" type="text" name="image" value="<?= $post->getImage(); ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                Slug : <input class="form-control" type="text" name="slug" value="<?= $post->getSlug(); ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                Contenu : <textarea class="form-control w-100" name="content" cols="30" rows="9"><?= $post->getContent(); ?></textarea>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                Auteur(e) : <input class="form-control" type="text" name="author" value="<?= $post->getAuthor(); ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <input class="form-control" type="hidden" name="userId" value="<?= $post->getUserId(); ?>">
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