<main id="main" class="main">
<div class="pagetitle">
    <h4>Reports</h4>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
        <li class="breadcrumb-item active"><a href="<?= base_url()?>">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="<?= base_url()."attendance"?>">Attendance</a></li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">
      <!-- Left side columns -->
      <form class="col-lg-12" method="post" action="<?= site_url('reports') ?>">
        <div class="row">
        <div class="col-md-2" style="position: relative;">
            <label for="user" class="form-label">User</label>
            <input type="hidden" id="userIdField" name="user_id" value="<?= $user?>">
            <input type="text" autocomplete="off" id="searchField" name="user" class="form-control form-control-sm" placeholder="user" value="<?= $user_name ?>">
            <ul id="searchResults" style="position: absolute; top: calc(100% + 4px); left: 0; color: #fff; background-color: grey; display: none; z-index: 1000; width: 100%;"></ul>
        </div>
          <div class="col-md-2">
            <label for="station" class="form-label">Station</label>
            <select id="station" name="station" class="form-select form-select-sm">
              <option value="">station</option>
              <option value="ZeTech01" <?=  ($station == 'ZeTech01')?'selected':''?>>ZeTech01</option>
            </select>
          </div>
          <div class="col-md-2">
            <label for="direction" class="form-label">Direction</label>
            <select id="direction" name="direction" class="form-select form-select-sm">
              <option value="">direction</option>
              <option value="OUT" <?= ($direction == "OUT"  )?'selected':''?>>OUT</option>
              <option value="IN" <?= ($direction == "IN"  )?'selected':''?>>IN</option>
            </select>
          </div>
          <div class="col-md-2">
            <label for="datefrom" class="form-label">Date From</label>
            <input type="date" id="datefrom" value="<?= $date_from?>" name="date_from" value="" class="form-control form-control-sm">
          </div>
          <div class="col-md-2">
            <label for="datetp" class="form-label">Date To</label>
            <input type="date" id="dateto" name="date_to" value="<?= $date_to?>" class="form-control form-control-sm">
          </div>
          <div class="col-md-2 mt-4">
            <button type="submit" class="btn btn-sm btn-secondary">Search</button>
          </div>
        </div>
      </form>
      <div class="col-lg-12 my-1">
        <div class="row">
        <div class="card-body">
                
                <?php if (!empty($attendance) && is_array($attendance)) : ?>

                    <table id="tableWithOutFilter" class="table table-bordered table-sm table-striped datatable">
                      <thead>
                        <tr>
                          <th>Staff ID</th>
                          <th>Context</th>
                          <th>Station Name</th>
                          <th>Device Name</th>
                          <!--<th>Direction (IN)</th> 
                          <th>Direction (OUT)</th>-->
                          <th>Time In</th>
                          <th>Time Out</th>
                          <th>Hrs In</th>

                        </tr>
                      </thead>
                      <tbody>

                      <?php foreach ($attendance as $att) : ?>
                          <tr>
                            <td><?= get_user_full_names(esc($att['StaffID'])) ?></a></td>
                            <td><?= esc($att['Context_in']) ?></td>
                            <td><?= esc($att['BaseStationName_in']) ?></td>
                            <td><?= esc($att['DeviceName_in']) ?></td>
                            <!--<td><?// esc($att['Direction_in']) ?></td>
                            <td><?// isset($att['Direction_out']) ? esc($att['Direction_out']) : '-' ?></td>
                          -->
                            <td data-sort="<?= $att['time_in']?>"><?= esc(formatDate($att['time_in'])) ?></td>
                            <td data-sort="<?= $att['time_out']?>"><?= isset($att['time_out']) ? esc(formatDate($att['time_out'])) : '-' ?></td>
                            <td>
                                <?php 
                                    $time_in = $att['time_in'];
                                    $time_out = isset($att['time_out']) ? $att['time_out'] : '-';
                                    echo esc(calculate_hours_in($time_in, $time_out));
                                ?>
                            </td>
                          </tr>
                      <?php endforeach; ?>

                      </tbody>
                    </table>
                    <div>
                    <?= $pager?>
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
