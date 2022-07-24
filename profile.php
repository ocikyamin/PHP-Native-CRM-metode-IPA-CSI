<?php include_once '_header.php';

?>
<?php

if (isset($_SESSION['pelanggan'])) {
    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM customer WHERE id=$_SESSION[pelanggan] "));
?>
<div class="container-fluid bg-light py-3">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Profile</h1>
    </div>
</div>
<section class="bg-light">
    <div class="container pb-5">


        <?php
            if (isset($_SESSION['pelanggan'])) {
                // cek apakah sudah pernah berhasil transaksi
                $transaksi_sukses = mysqli_num_rows(mysqli_query($con, "SELECT `user_id` FROM `cart` WHERE user_id=$_SESSION[pelanggan] AND `stt_transaksi`=1 "));

                if ($transaksi_sukses > 0) {
                    // cek jika belum pernah mengisi kusioner 
                    $getkusioner = mysqli_query($con, "SELECT `user_id` FROM `skors` WHERE user_id=$_SESSION[pelanggan] ");
                    if (mysqli_num_rows($getkusioner) < 1) {
            ?>
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16"
                    role="img" aria-label="Warning:">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg> Notification!</h4>
            <p>
                Kepada responden yang terhormat, <br>
                Kuesioner ini merupakan instrument dalam penelitian yang berjudul <b>Custumer Relationship
                    Management (Crm) Peningkatan Penjualan Gorden Berbasis Web Pada Usi-Usi Interior Bukittinggi
                    Menggunakan Metode <em>Importance Performance Analysis</em> (IPA) dan <em>Customer
                        Satisfaction Index</em> (CSI)</b>, guna penyelesaian tugas praktek kerja lapangan (pkl)
                Jurusan Sistem Informasi Fakultas Ilmu Komputer Universitas Putra Indonesia “Yptk” Padang, yang
                dilakukan oleh :
            <ul>
                <li> Nama : Reski Andrian 18101152610662</li>
            </ul>
            Saya mohon kesedian Bapak/Ibuk dan saudara untuk mengisi kuesioner ini secara lengkap. Informasi
            yang diterima dari hasil kuesioner ini bersifat rahasia dan dipergunakan untuk kepentingan akademis.
            <br> Atas perhatian dan kerjasamanya saya ucapkan terimakasih.
            </p>
            <a href="./start.php" class="btn btn-primary">Ya Saya Bersedia Berpartisipasi</a>

        </div>

        <?php
                    }
                }
            }

            ?>
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow" style="border-radius: 7px;">
                    <div class="card-header">
                        <b><i class="fa fa-cog"></i> Account Setting</b>
                    </div>
                    <div class="card-body text-center">
                        <img src="./public/assets/img/usiusi.png" class="img-thumbnail shadow"
                            style="border-radius: 100%; border:2px #fff solid;width:100px;height:100px"> <br>
                        <h5 class="mt-3"><b><?= $user['nama'] ?></b></h5>
                        <p>
                            <?= $user['user_email'] ?> <br>
                            <?= $user['user_hp'] ?>
                        </p>
                        <hr>

                        <button data-bs-toggle="modal" data-bs-target="#modalprofil" class="btn btn-success"><i
                                class="fas fa-user-edit"></i>
                            Update
                            Profile</button>
                        <a href="logout.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i>
                            Logout</a>

                    </div>
                    <div class="card-header">
                        <b><i class="fas fa-map-marker-alt"></i> Alamat Pengiriman</b>
                    </div>
                    <p>
                    <ul style="list-style:none">
                        <li>Provinsi : <b><?= $user['prov'] ?></b></li>
                        <li>Kab : <?= $user['kab'] ?></li>
                        <li>Alamat : <?= $user['alamat'] ?></li>
                    </ul>
                    </p>
                </div>
            </div>
            <div class="col-lg-8">
                <!-- <div class="card">  -->
                <div class="card-body">
                    <div class="row">

                        <a href="./cart.php" style="text-decoration: none;" class="col-md-6 col-lg-6 pb-5">
                            <div class="h-100 py-5 services-icon-wap shadow">
                                <div class="h1 text-success text-center"><i class="fa fa-cart-arrow-down fa-lg"></i>
                                </div>
                                <h2 class="h5 mt-4 text-center">Keranjang Belanja</h2>
                            </div>
                        </a>

                        <a href="./history.php" style="text-decoration: none;" class="col-md-6 col-lg-6 pb-5">
                            <div class="h-100 py-5 services-icon-wap shadow">
                                <div class="h1 text-success text-center"><i class="fa fa-history"></i></div>
                                <h2 class="h5 mt-4 text-center">Riwayat Transaksi</h2>
                            </div>
                        </a>

                        <!-- <a href="./payment.php" style="text-decoration: none;" class="col-md-6 col-lg-3 pb-5">
                            <div class="h-100 py-5 services-icon-wap shadow">
                                <div class="h1 text-success text-center"><i class="fas fa-money-check-alt"></i></div>
                                <h2 class="h5 mt-4 text-center">Pembayaran</h2>
                            </div>
                        </a>

                        <a href="./invoice.php" style="text-decoration: none;" class="col-md-6 col-lg-3 pb-5">
                            <div class="h-100 py-5 services-icon-wap shadow">
                                <div class="h1 text-success text-center"><i class="fas fa-file-invoice"></i></div>
                                <h2 class="h5 mt-4 text-center">Invoice</h2>
                            </div>
                        </a> -->
                    </div>
                </div>

                <!-- </div> -->


                <div id="formprofile" style="display: none;" class="card mt-3">
                    <div class="card-body">
                        jjj
                    </div>
                </div>

            </div>
            <!-- col end -->

        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="modalprofil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?= $user['nama'] ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label>Gender</label>
                        <select name="jk" class="form-control">
                            <option value="L">Laki-laki</option>
                            <option value="P" <?php if ($user['jk'] == 'P') {
                                                        echo "selected";
                                                    } ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Usia</label>
                        <input type="number" name="usia" class="form-control" value="<?= $user['usia'] ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label>Pendidikan</label>
                        <select name="pddk" id="pendidikan" class="form-control" required>
                            <option value="">Pilih Pendidikan</option>
                            <?php
                                $list_edu = mysqli_query($con, "SELECT * FROM tm_education ORDER BY id ASC");
                                foreach ($list_edu as $e) {
                                    if ($user['education_id'] == $e['id']) {
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }
                                    echo "<option value='$e[id]' $selected>$e[education_level]</option>";
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
                                    if ($user['job_id'] == $j['id']) {
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }
                                    echo "<option value='$j[id]' $selected>$j[job_name]</option>";
                                }
                                ?>
                        </select>
                    </div>



                    <div class="form-group mb-2">
                        <label>No.Hp / WhatsApp</label>
                        <input type="number" name="hp" class="form-control" value="<?= $user['user_hp'] ?>">
                    </div>
                    <p style="border-bottom: 1px dotted;">
                        <b> <i class="fa fa-key"></i> Akun</b>
                    </p>
                    <div class="form-group mb-2">
                        <label>E-Mail</label>
                        <input type="text" name="email" class="form-control" value=" <?= $user['user_email'] ?>"
                            disabled>
                    </div>
                    <p>
                        <b> <i class="fa fa-map"></i> Alamat</b>
                    </p>
                    <div class="form-group mb-2">
                        <label>Provinsi</label>
                        <input type="text" name="prov" class="form-control" value=" <?= $user['prov'] ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label>Kabupaten/Kota</label>
                        <input type="text" name="kab" class="form-control" value=" <?= $user['kab'] ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label>Alamat Lengkap</label>
                        <textarea type="text" name="alamat" class="form-control"
                            placeholder="Contoh : Jl.Melati No.5 Kota Bukiitinggi"> <?= $user['alamat'] ?></textarea>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            <?php
                if (isset($_POST['update'])) {
                    $id = $_SESSION['pelanggan'];
                    $nama = $_POST['nama'];
                    $jk = $_POST['jk'];
                    $usia = $_POST['usia'];
                    $pddk = $_POST['pddk'];
                    $pkj = $_POST['pkj'];
                    $hp = $_POST['hp'];
                    $prov = $_POST['prov'];
                    $kab = $_POST['kab'];
                    $alamat = $_POST['alamat'];

                    var_dump($id);
                    mysqli_query($con, "UPDATE `customer`
                     SET `nama`='$nama',`jk`='$jk',`user_hp`='$hp',`prov`='$prov',`kab`='$kab',`alamat`='$alamat',`usia`='$usia',`education_id`='$pddk',`job_id`='$pkj' WHERE id=$id");
                    echo " <script>
            alert('Profile diperbarui.');
            location='profile.php';
        </script>";
                }

                ?>
        </div>

    </div>
</div>
<?php
} else {
    echo "<script>
    location='login.php'
</script>";
}
?>

<!-- Open Content -->



<script>
function toggleElement() {
    var x = document.getElementById("formprofile");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>


<?php include_once '_footer.php';
?>