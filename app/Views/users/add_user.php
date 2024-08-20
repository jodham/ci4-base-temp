<main id="main" class="main">
    <div class="pagetitle">
        <h4>Add User</h4>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
            <li class="breadcrumb-item active"><a href="<?= base_url("users")?>">Users</a></li>
            <li class="breadcrumb-item active"><a href="<?= base_url()."add_user"?>">Add user</a></li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
         <form class="row add-user-form shadow-sm" action="<?= site_url()."add_user"?>" method="post">
            <div class="col-md-4 my-2">
                <label for="last name" class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control form-control-sm" placeholder="first name" value="<?= $first_name ?>">
            </div>
            <div class="col-md-4 my-2">
                <label for="last name" class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control form-control-sm" placeholder="last name" value="<?= $last_name ?>">
            </div>
            <div class="col-md-4 my-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control form-control-sm" placeholder="name@zetech.ac.ke" value="<?= $email ?>">
            </div>
            <div class="col-md-4 my-2">
                <label for="staffid" class="form-label">Staff No</label>
                <input type="text" name="staffId" class="form-control form-control-sm" placeholder="staff no" value="<?= $staffId ?>">
            </div>
            <div class="col-md-4 my-2">
                <label for="role" class="form-label">Role</label><br>
                <input type="radio" name="role" class=""  value="Default" <?php echo ($role == "Default") ? 'checked' : ''?>>  <span class="ml-2">Default</span><br>
                <input type="radio" name="role" class=""  value="Administrator" <?php echo ($role == "Administrator") ? 'checked' : ''?>>  <span class="ml-2">Administrator</span><br>
                <input type="radio" name="role" class=""  value="Super User" <?php echo ($role == "Super user") ? 'checked' : ''?>>  <span class="ml-2">Super User</span>
            </div>
            <div class="col-md-12 my-2">
                <button type="submit" class="btn btn-sm btn-secondary">Submit</button>
            </div>
        </form>
    </section>
</main>