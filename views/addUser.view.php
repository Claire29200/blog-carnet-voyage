<section class="hero-banner d-flex align-items-center">
  <div class="container text-center">
    <h2>Créer un compte</h2>
  </div>
</section>
<section class="contact-section area-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <form class="form-contact contact_form" method="post" action="index.php?controller=User&action=addUser">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                Prénom : <input class="form-control" placeholder="tapez votre prénom" type="text" name="firstName">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                Nom : <input class="form-control" placeholder="tapez votre nom" type="text" name="lastName">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                Mail : <input class="form-control" type="mail" placeholder="ex: marie@gmail.com"name="email">
              </div>
            </div>
            <hr>
            <div class="col-12">
              <div class="form-group">
                Pseudo : <input class="form-control" type="text" placeholder="ex: jeannot" name="pseudo">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                Mot de passe : <input class="form-control" placeholder="votre mot de passe doit contenir une majuscule, un chiffre et un caractère spécial *" type="password" name="pswd">
                *une majuscule, un chiffre et un caractère spécial
              </div>
              
            </div>
            <div class="col-12">
              <div class="form-group">
                Confirmez le mot de Passe : <input class="form-control"placeholder="confirmez votre mot de passe" type="password" name="confirmPswd">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <input class="form-control" type="hidden" name="userRole" value="membre">
              </div>
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="submit" class="button button-contactForm" name="ajouter" value="Créer un compte">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>