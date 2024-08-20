<main id="main" class="main">
    <div class="pagetitle">
        <h4>Edit User</h4>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url("users")?>">Users</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url()."edit_user"?>">edit user</a></li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
         <form class="row add-user-form shadow-sm" action="<?= site_url()."edit_user/".$id?>" method="post">
            <div class="col-md-4 my-2">
                <label for="last name" class="form-label">First Name</label>
                <input type="text" readonly name="first_name" class="form-control form-control-sm" placeholder="first name" value="<?= $first_name ?>">
            </div>
            <div class="col-md-4 my-2">
                <label for="last name" class="form-label">Last Name</label>
                <input type="text" readonly name="last_name" class="form-control form-control-sm" placeholder="last name" value="<?= $last_name ?>">
            </div>
            <div class="col-md-4 my-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" readonly name="email" class="form-control form-control-sm" placeholder="name@zetech.ac.ke" value="<?= $email ?>">
            </div>
            <div class="col-md-4 my-2">
                <label for="staffid" class="form-label">Staff No</label>
                <input type="text" readonly name="staffId" class="form-control form-control-sm" placeholder="staff no" value="<?= $staffId ?>">
            </div>
            <div class="col-md-4 my-2">
                <label for="role" class="form-label">Role</label><br>
                <input type="radio" name="role" class=""  value="0" <?php echo ($role == "0") ? 'checked' : ''?>>  <span class="ml-2">Default</span><br>
                <input type="radio" name="role" class=""  value="2" <?php echo ($role == "2") ? 'checked' : ''?>>  <span class="ml-2">Administrator</span><br>
                <input type="radio" name="role" class=""  value="1" <?php echo ($role == "1") ? 'checked' : ''?>>  <span class="ml-2">Super User</span>
            </div>
            <div  class="col-md-4 my-2" style="display: none;">
                <label for="resetpassword">Reset Password</label><br>
                <input type="radio" name="resetpass" id="resetpassword" checked value="0"> <span>No</span><br>
                <input type="radio" name="resetpass" id="resetpassword" value="1"> <span>Yes</span>
            </div>
            <div class="col-md-12 my-2">
                <button type="submit" class="btn btn-sm btn-secondary">Submit</button>
            </div>
        </form>
    </section>
</main>