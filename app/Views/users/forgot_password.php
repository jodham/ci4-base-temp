<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column">
        <div class="container">
                  <div class="pt-1">
                      <div class="d-flex justify-content-center">
                        <a href="<?= base_url()?>" class="logo d-block align-items-center w-auto">
                          <h5 class="d-none d-lg-block py-2">Biotime </h5>
                        </a>
                      </div><!-- End Logo -->
                  </div>                
                  <form class="row forgot-password-wrapper mt-3 shadow" id="reset-password-form" method='post' action="<?= site_url()."forgot_password"?>">
                    <div class="col-md-7 p-3">

                        <div class="mx-auto form-group">
                            <label class="" for="email">Email</label>
                            <div class='input-group'>
                                <input type="email" class="form-control" required value="<?= $email ?>" placeholder="name@zetech.ac.ke" name="email" id="email">
                            </div>
                        </div>

                        <div class="mx-auto form-group mt-2">
                            <label class="" for="staffno">Staff No.</label>
                            <div class="input-group">
                                <input type="text" class="form-control" required value="<?= $staffno ?>" placeholder="ZU/1234" name="staffno" id="staffno">
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 m-3">
                        <button type='submit' class='btn btn-sm btn-secondary text-white fw-bold'>Submit</button>
                    </div>

                 </form>
        </div>

      </section>

    </div>
  </main>