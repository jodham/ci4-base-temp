<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
      <li class="breadcrumb-item active"><a href="<?= base_url()?>">Home</a></li>
        <li class="breadcrumb-item active"><a href="<?= base_url()?>">Dashboard</a></li>
      </ol>
    </nav>
  </div>
  <!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">
          <?php if(get_logged_user_role() != "Default"): ?>
        <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">

              <a class="card-body" href="<?= base_url()."myattendance"?>">

                <h5 class="card-title">My attendance</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-book"></i>
                  </div>
                  <div class="ps-3">
                    <h6>view</h6>
                  </div>
                </div>
              </a>

            </div>
          </div>
          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">

              <a class="card-body" href="
              <?php if(get_logged_user_campus() == "Thika Road Campus"):?>
                <?= base_url()."attendancee?campus=trc"?>
                <?php elseif(get_logged_user_campus() == "Mang'u Campus"):?>
                  <?= base_url()."attendancee?campus=mangu"?>
                <?php else:?>
                  <?= base_url()."attendancee?campus=city"?>
                <?php endif;?>  
              ">
                <h5 class="card-title">Attendance</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>view</h6>
                  </div>
                </div>
              </a>

            </div>
          </div
          ><!-- End Sales Card -->
          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">
              <a class="card-body" href="<?= base_url()?>">

                <h5 class="card-title">Reports</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-book"></i>
                  </div>
                  <div class="ps-3">
                    <h6>view</h6>
                  </div>
                </div>
              </a>

            </div>
          </div>
          <!-- End Sales Card -->
          <!-- Revenue Card -->
           <?php if(get_logged_user_role() == "Super User"):?>
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">

              <a class="card-body" href="<?= base_url()."users"?>">

                <h5 class="card-title">Users</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-book"></i>
                  </div>
                  <div class="ps-3">
                    <h6>view</h6>
                  </div>
                </div>
              </a>

            </div>
          </div>
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">

              <a href="<?= base_url()?>" class="card-body">
                <h5 class="card-title">Logs</h5>

                <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-gear"></i>
                  </div>
                  <div class="ps-3">
                    <h6>view</h6>
                  </div>
                </div>
              </a>

            </div>
          </div>
          <?php endif;?>
          <!-- End Revenue Card -->

  

        </div>
        <?php endif;?>
      </div><!-- End Left side columns -->

    </div>
  </section>

</main>
<!-- End #main -->
