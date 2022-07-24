<?php include_once '_header.php'; ?>
<!-- Start Content Page -->
<!-- Start Contact -->

<div class="container py-5">
    <div class="row py-5">
        <div class="col-lg-12">
            <?php
            if (isset($_SESSION['pelanggan'])) {
                $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM customer WHERE id=$_SESSION[pelanggan] "));
                // cek jika belum pernah mengisi kusioner 
                $getkusioner = mysqli_query($con, "SELECT `user_id` FROM `skors` WHERE user_id=$_SESSION[pelanggan] AND type='Kepentingan' ");
                if (mysqli_num_rows($getkusioner) > 0) {
                    echo "<script>location='profile.php';</script>";
                }
            ?>
            <form method="POST">
                <div class="row">
                    <div class="col lg-4">
                        <table class="table table-striped info-cus">
                            <thead>
                                <tr>
                                    <td>Nama Responden</td>
                                    <td>:</td>
                                    <td> <?= $user['nama'] ?> </td>
                                </tr>
                                <tr>
                                    <td>Waktu Submit</td>
                                    <td>:</td>
                                    <td> <?= date('d-m-Y H:i:s', strtotime($user['create_at'])) ?> </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="alert alert-success intruksi">
                    <p>
                        Di bawah ini terdapat pertanyaan-pertanyaan yang berkaitan dengan tingkat kepentingan dan
                        kinerja menurut menurut persepsi anda sebagai pelanggan Usi-Usi Interior Bukittinggi.
                        Dimohon anda memberikan penilaian dengan tanda check pada kotak-kotak pertanyaan tersebut.
                    <ul>
                        <li> Tingkat kenyataan (kinerja yang diterima) menyatakan seberapa puas layanan yang sudah
                            anda terima. </li>
                        <li>Tingkat kepentingan (harapan pelanggan) menyatakan seberapa penting layanan tersebut.</li>
                    </ul>

                    </p>
                    <p>
                    <ol>
                        <li>Sangat Tidak Penting (STP)</li>
                        <li>Tidak Penting &nbsp;(TP)</li>
                        <li>Cukup Penting (CP) </li>
                        <li>Penting (P)</li>
                        <li>Sangat Penting (SP)</li>
                    </ol>
                    </p>
                    <!-- <b>Petunjuk :</b> Isilah dengan memberi tanda silang (X) pada jawaban yang anda anggap benar. -->
                </div>

                <?php
                    // cek jika sudah ada kepuadan yg di isi
                    $sqlKepuasan = mysqli_query($con, "SELECT user_id FROM skors WHERE user_id=$user[id] AND type='Kepuasan'  ");
                    $cekKepuasan = mysqli_num_rows($sqlKepuasan);

                    ?>

                <div class="table-responsive">
                    <table class="table kusioner">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pertanyaan</th>
                                <th scope="col"><?php if ($cekKepuasan < 1) {
                                                        echo 'Kepuasan';
                                                    } else {
                                                        echo 'Kepentingan';
                                                    } ?>
                                </th>
                                <!-- <th scope="col">Kepentingan</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $listPertanyaan = mysqli_query($con, "SELECT * FROM tm_atribut ORDER BY id ASC");
                                foreach ($listPertanyaan as $i => $p) {
                                ?>
                            <tr>
                                <th scope="row"> <?= $no++ ?> </th>
                                <td><?= $p['atribut'] ?></td>
                                <td>
                                    <input type="hidden" name="jml_atr[]" value="<?= $p['id'] ?>">
                                    <input type="hidden" name="atribut-<?= $i ?>" value="<?= $p['id'] ?>">
                                    <div class="form-check form-check-inline">
                                        <input name="puas-<?= $i ?>" class="form-check-input" type="checkbox"
                                            id="p-<?= $i ?>" value="1">
                                        <label class="form-check-label" for="p-<?= $i ?>">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="puas-<?= $i ?>" class="form-check-input" type="checkbox"
                                            id="p-<?= $i ?>" value="2">
                                        <label class="form-check-label" for="p-<?= $i ?>">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="puas-<?= $i ?>" class="form-check-input" type="checkbox"
                                            id="p-<?= $i ?>" value="3">
                                        <label class="form-check-label" for="p-<?= $i ?>">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="puas-<?= $i ?>" class="form-check-input" type="checkbox"
                                            id="p-<?= $i ?>" value="4">
                                        <label class="form-check-label" for="p-<?= $i ?>">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="puas-<?= $i ?>" class="form-check-input" type="checkbox"
                                            id="p-<?= $i ?>" value="5">
                                        <label class="form-check-label" for="p-<?= $i ?>">5</label>
                                    </div>

                                </td>
                            </tr>

                            <?php
                                }

                                ?>

                            <tr>
                                <td colspan="4" align="center">
                                    <?php if ($cekKepuasan < 1) {
                                        ?>
                                    <button type="submit" name="submit" class="btn btn-success"
                                        onkeyup="return confirm('Apakah Anda Yakin Untuk Melanjutkan ? Selanjutnya akan diarah ke pengisian Tingkat Kepentingan, Klik OK Jika Iya')">
                                        <i class="bi bi-arrow-right"></i> Kirim & Lanjutkan</button>
                                    <?php
                                        } else {
                                        ?>
                                    <button type="submit" name="submitKepentingan" class="btn btn-success"
                                        onkeyup="return confirm('Apakah Anda Yakin ? Jawaban Ini akan dikirim ')"><i
                                            class="bi bi-send"></i> Submit</button>
                                    <?php
                                        } ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </form>
            <?php
                if (isset($_POST['submit'])) {
                    $userID       = $user['id'];
                    $barisAtribut = count($_POST['jml_atr']);
                    for ($puaskah = 0; $puaskah <= $barisAtribut - 1; $puaskah++) {
                        $atributID    = $_POST['atribut-' . $puaskah];
                        $puas         = $_POST['puas-' . $puaskah];

                        $save = mysqli_query($con, "INSERT INTO `skors`(`user_id`, `atribut_id`, `skor`, `type`) VALUES ('$userID','$atributID','$puas','Kepuasan')");
                    }
                    if ($save) {
                        echo " <script>
location='start.php'
 </script>";
                    }
                }

                // sinpan kusioner pentingan
                if (isset($_POST['submitKepentingan'])) {
                    $userID       = $user['id'];
                    $barisAtribut = count($_POST['jml_atr']);
                    for ($pentingkah = 0; $pentingkah <= $barisAtribut - 1; $pentingkah++) {
                        $atributID    = $_POST['atribut-' . $pentingkah];
                        $penting         = $_POST['puas-' . $pentingkah];

                        $save = mysqli_query($con, "INSERT INTO `skors`(`user_id`, `atribut_id`, `skor`, `type`) VALUES ('$userID','$atributID','$penting','Kepentingan')");
                    }
                    if ($save) {
                        echo " <script>
       alert('Termakasih Jawaban anda telah dikirim');
       location='profile.php'
 </script>";
                    }
                }
                ?>



            <?php
            }


            ?>
        </div>

    </div>
</div>
<!-- End Contact -->

<?php include_once '_footer.php';