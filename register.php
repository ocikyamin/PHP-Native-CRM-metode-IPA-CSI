<?php include_once '_header.php'; ?>
<section class="bg-success py-5">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-md-4 text-white">
            </div>
            <div class="col-md-4">
                <div class="alert bg-warning shadow">
                    Klik <a href="login.php">Login </a> Jika Sudah Punya Akun
                </div>
                <div class="row">
                    <div class="card shadow">
                        <div class="card-body">

                            <p style="border-bottom: 1px dotted;">
                                <b> <i class="fa fa-pencil-alt"></i> Registrasi Akun</b>
                            </p>
                            <form method="post">
                                <div class="form-group mb-2">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                                </div>
                                <div class="form-group mb-2">
                                    <label>Gender</label>
                                    <select name="jk" class="form-control">
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Usia</label>
                                    <input type="number" name="usia" class="form-control" placeholder="30">
                                </div>
                                <div class="form-group mb-2">
                                    <label>Pendidikan</label>
                                    <select name="pddk" id="pendidikan" class="form-control" required>
                                        <option value="">Pilih Pendidikan</option>
                                        <?php
                                        $list_edu = mysqli_query($con, "SELECT * FROM tm_education ORDER BY id ASC");
                                        foreach ($list_edu as $e) {
                                            echo "<option value='$e[id]'>$e[education_level]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Pekerjaan</label>
                                    <select name="pkj" id="pekerjaan" class="form-control" required>
                                        <option value="">Pilih Pekerjaan</option>
                                        <?php
                                        $list_job = mysqli_query($con, "SELECT * FROM tm_job ORDER BY id ASC");
                                        foreach ($list_job as $j) {
                                            echo "<option value='$j[id]'>$j[job_name]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>



                                <div class="form-group mb-2">
                                    <label>No.Hp / WhatsApp</label>
                                    <input type="number" name="hp" class="form-control" placeholder="62">
                                </div>
                                <p style="border-bottom: 1px dotted;">
                                    <b> <i class="fa fa-key"></i> Akun</b>
                                </p>
                                <div class="form-group mb-2">
                                    <label>E-Mail</label>
                                    <input type="text" name="email" class="form-control"
                                        placeholder="example@gmail.com">
                                </div>
                                <div class="form-group mb-2">
                                    <label>Password</label>
                                    <input type="text" name="pass" class="form-control" placeholder="*****">
                                </div>
                                <div class="form-group mb-2">
                                    <label>Ulangi Password</label>
                                    <input type="text" name="re_pass" class="form-control" placeholder="*****">
                                </div>
                                <!-- <p>
                                    <b> <i class="fa fa-map"></i> Alamat</b>
                                </p>
                                <div class="form-group mb-2">
                                    <label>Provinsi</label>
                                    <input type="text" name="prov" class="form-control" placeholder="Contoh : Bengkulu">
                                </div>
                                <div class="form-group mb-2">
                                    <label>Kabupaten/Kota</label>
                                    <input type="text" name="kab" class="form-control" placeholder="Contoh : Mukomuko">
                                </div>
                                <div class="form-group mb-2">
                                    <label>Alamat Lengkap</label>
                                    <textarea type="text" name="alamat" class="form-control"
                                        placeholder="Contoh : Jl.Melati No.5 Kota Bukiitinggi"></textarea>
                                </div> -->
                                <div class="form-group mt-3">
                                    <button type="submit" name="new_akun" class="btn btn-primary"> <i
                                            class="fas fa-sign-in-alt"></i> Register</button>
                                    Sudah Punya Akun ? <a href="login.php">Login</a>
                                </div>
                                <p>

                                </p>

                            </form>
                            <?php
                            if (isset($_POST['new_akun'])) {
                                $nama = $_POST['nama'];
                                $jk = $_POST['jk'];
                                $usia = $_POST['usia'];
                                $pddk = $_POST['pddk'];
                                $pkj = $_POST['pkj'];
                                $hp = $_POST['hp'];
                                $email = $_POST['email'];
                                $pass = sha1($_POST['pass']);
                                $npass = sha1($_POST['re_pass']);
                                // required 
                                if ($nama == "" || $jk == "" || $usia == "" || $pddk == "" || $pkj == "" || $hp == "" || $email == "" || $pass == "" || $npass == "") {
                                    echo "<script> alert('Email / Password Wajib Diisi');</script>";
                                } else {
                                    // cek email 
                                    // cek confirm password 
                                    if ($pass == $npass) {
                                        $get = mysqli_query($con, "SELECT user_email FROM customer WHERE user_email='$email' ");
                                        if (mysqli_num_rows($get) < 1) {
                                            // echo "lnjutt";
                                            mysqli_query($con, "INSERT INTO
                                             `customer`(`user_kode`, `user_email`, `nama`, `jk`, `user_hp`,`usia`, `education_id`, `job_id`) 
                                             VALUES ('$npass','$email','$nama','$jk','$hp','$usia','$pddk','$pkj')");
                                            $_SESSION['pelanggan'] = mysqli_insert_id($con);
                                            if (isset($_SESSION['cart']) or !empty($_SESSION['cart'])) {
                                                echo "<script>
                                                alert('Pendfatran Akun Berhasil');
                                location='cart.php';
                            </script>";
                                            } else {
                                                echo "<script>
                               alert('Pendfatran Akun Berhasil');
                                location='profile.php';
                            </script>";
                                            }
                                        } else {
                                            echo "<script> alert('Email Telah terdaftar');</script>";
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger'>Konfirmasi Password Tidak Sama</div>";
                                    }
                                }

                                //     $email = mysqli_real_escape_string($con, $_POST['ue']);
                                //     $pass = sha1($_POST['up']);
                                //     if ($email == "" || $pass == "") {
                                //         echo "<script>
                                //     alert('Email / Password Wajib Diisi');
                                // </script>";
                                //     } else {
                                //         $sql = mysqli_query($con, "SELECT `id`,  `user_kode`, `user_email` FROM `customer` WHERE `user_kode`='$pass' AND `user_email`='$email'  ");
                                //         // cek jika email ditemukan 
                                //         if (mysqli_num_rows($sql) > 0) {
                                //             $du = mysqli_fetch_assoc($sql);
                                //             $_SESSION['pelanggan'] = $du['id'];
                                //             echo "<script>
                                //     alert('Berhasil Login.');
                                //     location='profile.php';
                                // </script>";
                                //         } else {
                                //             echo "<script>
                                //     alert('Gagal Login.');
                                // </script>";
                                //         }
                                //     }
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