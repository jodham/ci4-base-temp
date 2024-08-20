<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Biotime</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url("assets/img/favicon.ico")?>" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url("assets/vendor/bootstrap/css/bootstrap.min.css")?>" rel="stylesheet">
  <link href="<?= base_url("assets/vendor/bootstrap-icons/bootstrap-icons.css")?>" rel="stylesheet">
  <link href="<?= base_url("assets/vendor/boxicons/css/boxicons.min.css")?>" rel="stylesheet">
  
  <link href="<?= base_url("assets/vendor/simple-datatables/style.css")?>" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

  
  <!-- Template Main CSS File -->
  <link href="<?= base_url(). "assets/css/style.css"?>" rel="stylesheet">
</head>

<body>
<?php if(session()->has('Biotimelogged')):?>
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
    <a href="<?= base_url()?>" class="logo d-flex align-items-center">
        <img src="<?= base_url(). "assets/img/logo.png"?>" alt="">
        <span class="d-none d-lg-block">Biotime</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

          <li class="nav-item dropdown pe-3">

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img src="<?= base_url(). "assets/img/avatar.png"?>" alt="Profile" class="rounded-circle">
                <span class="d-none d-md-block dropdown-toggle ps-2"><?= get_name_initial()?></span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                <h6><?= get_logged_user_names()?></h6>
                <span><?= get_logged_user_role()?></span>
                </li>
                <li>
                <hr class="dropdown-divider">
                </li>

                <li>
                <a class="dropdown-item d-flex align-items-center" href="<?= base_url()."profile"?>">
                    <i class="bi bi-person"></i>
                    <span>My Profile</span>
                </a>
                </li>
                <li>
                <hr class="dropdown-divider">
                </li>

                <li>
                <a class="dropdown-item d-flex align-items-center" href="<?= base_url()."signout"?>">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
                </li>

            </ul><!-- End Profile Dropdown Items -->
          </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

</header>
<!-- End Header -->
  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <?php if(get_logged_user_role() != "Default"):?>
        <li class="nav-item">
          <a class="nav-link " href="<?= base_url()?>">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          
          </a>
        </li>
      <?php else:?>
        <li class="nav-item">
          <a class="nav-link " href="<?= base_url()."myattendance"?>">
            <i class="bi bi-grid"></i>
            <span>My Attendance</span>
          
          </a>
        </li>
      <?php endif;?>
      <!-- End Dashboard Nav -->
      <?php if(get_logged_user_role() != "Default"):?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-people"></i><span>Attendance</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
          <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="<?= base_url()."attendancee?campus=trc"?>">
                <i class="bi bi-circle"></i><span>TRC</span>
              </a>
              <a href="<?= base_url()."attendancee?campus=mangu"?>">
                <i class="bi bi-circle"></i><span>Mang'u Campus</span>
              </a>
              <a href="<?= base_url()."attendancee?campus=city"?>">
                <i class="bi bi-circle"></i><span>City Campus</span>
              </a>
            </li>
          </ul>
      </li>
      <?php endif;?>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url()."meetings"?>">
          <i class="bi bi-people"></i>
          <span>Meetings</span>
        </a>
      </li>
    <?php if(get_logged_user_role() != "Default"):?>
      <!-- <li class="nav-item">
        <a class="nav-link " href="<?// base_url()."reports"?>">
          <i class="bi bi-book"></i>
          <span>Reports</span>
        </a>
      </li> -->
      <?php endif;?>
      <!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url()."profile"?>">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>
      <!-- End Profile Page Nav -->

    

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url()."signout"?>">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>logout</span>
        </a>
      </li><!-- End Login Page Nav -->

    </ul>

  </aside>
  <?php endif;?>
  <!-- End Sidebar-->

    <?php if(!empty($content))
    if(session()->getFlashdata('success')){
      echo '<div class="row flash-message fade-out">
      <div class="message-container message-row col-md-12 d-flex justify-content-center">
        <div class="message p-2 bg-success text-white success-message text-center" id="message">
          '. session()->getFlashdata('success'). '
        
        </div>
        </div>
        </div>';
    }

    if(session()->getFlashdata('error')){
      echo '<div class="row flash-message fade-out">
      <div class="message-container message-row col-md-12 d-flex justify-content-center">
        <div class="message p-2 bg-danger text-white error-message text-center" id="message">
          '. session()->getFlashdata('error'). '
          
        </div>
        </div>
        </div>';
    }
    {echo $content;}
    ?>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Zetech university <?= date("Y")?></span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script>
  var base_url = "<?php echo base_url()?>";
</script>
  <!-- Vendor JS Files -->

  <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="<?= base_url("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")?>"></script>
    <!-- PDFMake for PDF export -->
    <script defer type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script defer type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>


    <script defer type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>

    <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script defer type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
    <script defer type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>
    <script defer src="<?= base_url("assets/js/main.js")?>"></script>
   


   

</body>

</html>