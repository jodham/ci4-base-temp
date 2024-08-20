<main id="main" class="main">
<div class="pagetitle">
    <h4>Attendance</h4>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
        <li class="breadcrumb-item active"><a href="<?= base_url()?>">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="<?= base_url()."users"?>">users</a></li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row shadow-lg">
      <div class="col-lg-12 my-1">
        <div class="row">
        <div class="card-body">
                <?php if (!empty($users) && is_array($users)) : ?>
                  <table id="userstable" class="table table-bordered table-sm table-striped userstable mt-1">
                    <thead>
                      <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($users as $att) : ?>
                        <tr>
                          <td><?= esc($att['FirstName']) ?></td>
                          <td><?= esc($att['LastName']) ?></td>
                          <td><?= esc($att['Email']) ?></td>
                          <td>
                            <?php if(esc($att['Role']) =="2"){
                              echo "Administrator";
                            }elseif(esc($att['Role']) =="1"){
                              echo "Super User";
                            }else{
                              echo "Default";
                            }
                              ?>

                          </td> 
                          <td><?= (esc($att['Status']) == 1) ? 'Active' : 'Disabled'; ?></td> 
                          <td>
                            <a href="<?= base_url()."edit_user/".esc($att['id'])?>" title="edit user"><i class="bi bi-pencil-square mx-2"></i></a>
                                      
                            <?php if(esc($att['id']) != get_logged_user_id()):?>
                              <?php if(esc($att['Status']) == 1):?>
                              <a href="#" class="disable-user" data-id="<?= esc($att['id']) ?>" title="disable user"><i class="bi bi-tools mx-2 text-danger"></i></a>
                              <?php else:?>
                                <a href="#" class="enable-user" data-id="<?= esc($att['id']) ?>" title="Activate user"><i class="bi bi-tools mx-2"></i></a>
                              <?php endif;?>
                            <?php else:?>
                              <a href="#" class="" title="you can't disable yourself"><i class="bi bi-lock mx-2 text-secondary"></i></a>
                            <?php endif;?>
                          </td>                       
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                  </table>
                  <div>
                  <?// $pager ?>
                  </div>
                <?php else:?>
                  <p class="text-warning">No attendance record available</p>
                <?php endif;?>
              </div>
        </div>
      </div>
      <!-- End Left side columns -->
    </div>
  </section>
</main>
