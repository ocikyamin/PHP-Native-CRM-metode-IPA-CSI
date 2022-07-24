<div class="pagetitle">
    <h1>Pelanggan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">CRM</li>
            <li class="breadcrumb-item active">Pelanggan</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List Pelanggan</h5>
                    <p>
                    <form method="post" action="../report/responden/" target="_blank" style="display: inline;">
                        <!-- <button type="submit" name="print" class="btn btn-warning"><i class="bx bx-printer me-1"></i>
                            Print</button> -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addPelanggan" class="btn btn-success"><i
                                class="bx bx-plus"></i> Tambah Pelanggan</a>
                    </form>
                    </p>
                    <div class="table-responsive">
                        <table class="table datatable table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Pendidikan</th>
                                    <th scope="col">Pekerjaan</th>
                                    <th scope="col">Pelanggan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $listResponden = mysqli_query($con, "SELECT customer.id,customer.nama,customer.jk,customer.jenis_pel, tm_education.education_level,tm_job.job_name
                  	FROM customer 
                   JOIN tm_education ON customer.education_id=tm_education.id
                   JOIN tm_job ON customer.job_id=tm_job.id
                    ORDER BY customer.id ASC ");

                                foreach ($listResponden as $a) {
                                ?>
                                <tr>
                                    <th scope="row"> <?= $i++ ?>. </th>
                                    <td><?= $a['nama'] ?></td>
                                    <td><?= $a['jk'] ?></td>
                                    <td><?= $a['education_level'] ?></td>
                                    <td><?= $a['job_name'] ?></td>
                                    <td>
                                        <?php
                                            if ($a['jenis_pel'] == 'B') {
                                                echo '<span class="badge rounded-pill bg-primary">Baru</span>';
                                            } else {
                                                echo '<span class="badge rounded-pill bg-secondary">Lama</span>';
                                            }
                                            ?></td>
                                    <td>
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?= $a['id']; ?>">
                                            <button
                                                onclick="return confirm('Apakah Anda Yakin akan menghapus data ini ?')"
                                                type="submit" name="del" class="btn btn-danger btn-sm"><i
                                                    class="bx bx-trash-alt"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                }

                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<div class="modal fade" id="addPelanggan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">
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
                        <input type="text" name="email" class="form-control" placeholder="example@gmail.com">
                    </div>
                    <div class="form-group mb-2">
                        <label>Password</label>
                        <input type="text" name="pass" class="form-control" placeholder="*****">
                    </div>
                    <div class="form-group mb-2">
                        <label>Ulangi Password</label>
                        <input type="text" name="re_pass" class="form-control" placeholder="*****">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="new_akun" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End Basic Modal-->
<?php
// hapus record 
if (isset($_POST['del'])) {
    $id = intval($_POST['id']);
    mysqli_query($con, "DELETE FROM `customer` WHERE id=$id");
    echo "<script>
                                                alert('Pelanggan Telah dihapus.');
                                location='?/=pelanggan';
                            </script>";
}
// simpan pelanggan lama 
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
                                             `customer`(`user_kode`, `user_email`, `nama`, `jk`, `user_hp`,`usia`, `education_id`, `job_id`,`jenis_pel`) 
                                             VALUES ('$npass','$email','$nama','$jk','$hp','$usia','$pddk','$pkj','L')");
                echo "<script>
                                                alert('Pelanggan Berhasil Ditambahkan.');
                                location='?/=pelanggan';
                            </script>";
            } else {
                echo "<script> alert('Email Pelanggan Telah terdaftar');</script>";
            }
        } else {
            echo "<div class='alert alert-danger'>Konfirmasi Password Tidak Sama</div>";
        }
    }
}
?>