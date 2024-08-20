<main id="main" class="main">
<div class="pagetitle">
    <h4>logs</h4>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
        <li class="breadcrumb-item active"><a href="<?= base_url()?>">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="<?= base_url()."logs"?>">logs</a></li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">
  
      <div class="col-lg-12">
        <div class="row">
        <div class="card-body">
                <?php if (!empty($logs) && is_array($logs)) : ?>

                  <table  class="table table-bordered table-striped table-sm  logs-table">
                    <thead>
                      <tr>
                        <th scope="col">User</th>
                        <th scope="col">Action</th>
                        <th scope="col">Time</th>
                      
                      </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($logs as $log) : ?>
                      <tr>
                          <td><?= get_user_names(esc($log['user'])) ?></td>
                        <td><?= esc($log['action']) ?></td>
                        <td data-sort="<?= $log['time']?>"><?= esc(formatDate($log['time'])) ?></td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                  <div id="pagination_wrapper">
                      <?= $pager ?>
                  </div>
                <?php else:?>
                  <p class="text-warning">No log record available</p>
                <?php endif;?>
              </div>
        </div>
      </div>
      <!-- End Left side columns -->
    </div>
  </section>
</main>