<div class="pagetitle">
    <h1>Account</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active">Account Setting</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> <i class="bi bi-gear"></i> Pengaturan Akun Admin</h5>
                    <form method="post">
                        <input name="id" type="hidden" value="<?= $user['id'] ?>">
                        <div class="form-group mb-3">
                            <label> Nama Pengguna</label>
                            <input name="username" type="text" class="form-control" placeholder="Your Name"
                                value="<?= $user['username'] ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label> Email</label>
                            <input name="email" type="text" class="form-control" placeholder="Your Email"
                                value="<?= $user['email'] ?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="update" class="btn btn-primary"><i class="bi bi-check"></i>
                                Update</button>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#formPassword" class="btn btn-danger"><i
                                    class="bi bi-key"></i>
                                Ganti Password</a>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['update'])) {
                        $id = intval($_POST['id']);
                        $user = $_POST['username'];
                        $email = $_POST['email'];

                        mysqli_query($con, "UPDATE `user` SET `email`='$email',`username`='$user' WHERE id=$id");
                        echo "<script>
                                                alert('Account Diperbarui.');
                                location='?/=account';
                            </script>";
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="formPassword" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ganti Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <input name="id" type="hidden" value="<?= $user['id'] ?>">

                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Password Lama</label>
                        <input name="old_pass" type="text" class="form-control" placeholder="Masukkan Password Lama">
                    </div>

                    <div class="form-group">
                        <label>Password Baru</label>
                        <input name="new_pass" type="text" class="form-control" placeholder="Masukkan Password Baru">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="ganti_pass" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Small Modal-->

<?php
if (isset($_POST['ganti_pass'])) {
    $id = intval($_POST['id']);
    $old_pass = sha1($_POST['old_pass']);
    $new_pass = sha1($_POST['new_pass']);
    // cek password lama 
    $getOldPassword = $user['password'];
    if ($old_pass == "" || $new_pass == "") {
        echo "<script>alert('Inputan wajib diisi.');location='?/=account';</script>";
    } else {
        if ($old_pass == $getOldPassword) {
            mysqli_query($con, "UPDATE `user` SET `password`='$new_pass' WHERE id=$id");
            echo "<script>alert('Password Telah diperbarui.');location='?/=account'; </script>";
        } else {
            // echo "tidak sama";
            echo "<script>alert('Password Lama Tidak ditemukan');location='?/=account';</script>";
        }
    }
}

?>

<br>
<br>
<br>
<br>
<br>
<br>