<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4">
                      <div class="d-flex justify-content-center">
                        <a href="<?= base_url()?>" class="logo d-block align-items-center w-auto">
                          <img src="<?= base_url()."assets/img/logo.jpg"?>" alt="logo" width="100%">
                          <h5 class="d-none d-lg-block py-2">Biotime</h5>
                        </a>
                      </div><!-- End Logo -->
                  </div>

                  <form class="row g-3 needs-validation" action="<?= site_url()."login"?>" method="post">

                    <div class="col-12">
                      <label for="Username" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" value="<?= $email?>" name="email" class="form-control" id="Username" required>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="Password" class="form-label">Password</label>
                      <input type="password" value="<?=  $password?>" name="password" class="form-control" id="Password" required>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                      <a class="ml-auto mt-1 forgot password-label" href="<?= base_url()."forgot_password"?>">forgot password</a>
                    </div>
                   
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>