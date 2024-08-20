<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10 col-md-8 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-1">
                      <div class="d-flex justify-content-center">
                        <a href="<?= base_url()?>" class="logo d-block align-items-center w-auto">
                          <h5 class="d-none d-lg-block py-2">Biotime</h5>
                        </a>
                      </div><!-- End Logo -->
                  </div>
                  <div class="row" style="background-color: #CCE0F9;">
                   
                        <p class=""><i class="bi bi-info-circle"></i> <i>Password requirement</i></p>
                        <p class="">Password should contain atleast :</p>
                        <div class="col-md-3 mt-1  pass-requirement">i. 1 Uppercase & 1 lowercase letter</div>
                        <div class="col-md-3 mt-1  pass-requirement">iii. a special character i.e @#$%&*?</div>
                        <div class="col-md-3 mt-1  pass-requirement">iv. a number i.e 123</div>
                        <div class="col-md-3 mt-1  pass-requirement">iv. a minimum length of 8 characters.</div>
                     
                 </div>

                  
                  <form class="row forgot-password-wrapper mt-3 shadow" id="reset-password-form" method='post' action="<?= site_url()."reset_password"?>">
                    <div class="col-md-7 p-3">

                        <div class="mx-auto form-group">
                            <label class="">Current Password</label>
                            <div class='input-group'>
                                <input type="password" class="form-control" required value="<?= $current_password ?>" placeholder="current password" name="current_pass" id="current-password-field">
                                <button type="button" class="btn btn-outline-secondary" id="current-password-toggle">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mx-auto form-group mt-2">
                            <label class="">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" required value="<?= $new_password ?>" placeholder="new password" name="pass1" id="new-password-field">
                                <button type="button" class="btn btn-outline-secondary" id="new-password-toggle">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mx-auto form-group mt-2">
                            <label class="">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" required class="form-control" value="<?= $confirm_password ?>" placeholder="confirm new password" name="pass2" id="confirm-password-field">
                                <button type="button" class="btn btn-outline-secondary" id="confirm-password-toggle">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 m-3">
                        <button type='submit' class='btn btn-sm btn-secondary text-white fw-bold'>Submit</button>
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