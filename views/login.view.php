<section class="hero-banner d-flex align-items-center">
  <div class="container text-center">
    <h2>Se connecter</h2>
  </div>
</section>
<section class="contact-section area-padding">
  <div class="container">
    <div class="row">     
      <div class="col-lg-8">
        <form class="form-contact contact_form" method="post" action="index.php?controller=User&action=authentification">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                Email : <input class="form-control" placeholder= "saisissez votre email" type="email" name="email">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                Mot de passe : <input class="form-control" placeholder= "saisissez votre mot de passe" type="password" name="pswd">
              </div>
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="submit" class="button button-contactForm" name="login" value="valider">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>