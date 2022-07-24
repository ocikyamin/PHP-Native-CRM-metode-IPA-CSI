<?php include_once '_header.php'; ?>



<section class="bg-success py-5">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-md-4 text-white">
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="card shadow">
                        <div class="card-body">
                            <p>
                                <b> <i class="fas fa-sign-in-alt"></i> Login Pelanggan</b>
                            </p>
                            <form method="post">
                                <div class="form-group mb-2">
                                    <input type="text" name="ue" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="up" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" name="bl" class="btn btn-success"> <i
                                            class="fas fa-sign-in-alt"></i> Login</button>
                                    Belum Punya Akun ? <a href="register.php">Daftar</a>
                                </div>
                                <p>

                                </p>

                            </form>

                            <?php
                            if (isset($_POST['bl'])) {
                                $email = mysqli_real_escape_string($con, $_POST['ue']);
                                $pass = sha1($_POST['up']);
                                if ($email == "" || $pass == "") {
                                    echo "<script>
                                alert('Email / Password Wajib Diisi');
                            </script>";
                                } else {
                                    $sql = mysqli_query($con, "SELECT `id`,  `user_kode`, `user_email` FROM `customer` WHERE `user_kode`='$pass' AND `user_email`='$email'  ");
                                    // cek jika email ditemukan 
                                    if (mysqli_num_rows($sql) > 0) {
                                        $du = mysqli_fetch_assoc($sql);
                                        $_SESSION['pelanggan'] = $du['id'];
                                        if (isset($_SESSION['cart']) or !empty($_SESSION['cart'])) {
                                            echo "<script>
                                location='cart.php';
                            </script>";
                                        } else {
                                            echo "<script>
                                alert('Berhasil Login.');
                                location='profile.php';
                            </script>";
                                        }
                                    } else {
                                        echo "<script>
                                alert('Gagal Login.');
                            </script>";
                                    }
                                }
                            }
                            ?>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <!-- <img src="./public/front/assets/img/about-hero.svg" alt="About Hero"> -->
            </div>
        </div>
    </div>
</section>
<!-- Close Banner -->


<!--End Brands-->

<?php include_once '_footer.php'; ?>