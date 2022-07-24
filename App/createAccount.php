  <main id="main">

      <!-- ======= Breadcrumbs ======= -->
      <section id="breadcrumbs" class="breadcrumbs">
          <div class="container">

              <ol>
                  <li><a href="./">Home</a></li>
                  <li>Kusioner</li>
              </ol>
              <h2>Kusioner</h2>

          </div>
      </section><!-- End Breadcrumbs -->

      <section class="inner-page">
          <div class="container">
              <?php
        // cek jika tidak ada sessin responden
        if (empty($_SESSION['startResponden'])) {
          // session_destroy();
          // echo 'tidak ada session';
        ?>
              <div class="row">
                  <div class="col-lg-12">
                      <div class="alert alert-info info-cus">
                          <p>
                              Kepada responden yang terhormat, <br>
                              Kuesioner ini merupakan instrument dalam penelitian yang berjudul <b>Custumer Relationship
                                  Management (Crm) Peningkatan Penjualan Gorden Berbasis Web Pada Usi-Usi Interior
                                  Bukittinggi Menggunakan Metode <em>Importance Performance Analysis</em> (IPA) dan
                                  <em>Customer Satisfaction Index</em> (CSI)</b>, guna penyelesaian tugas praktek kerja
                              lapangan (pkl) Jurusan Sistem Informasi Fakultas Ilmu Komputer Universitas Putra Indonesia
                              “Yptk” Padang, yang dilakukan oleh :
                          <ul>
                              <li> Nama : Reski Andrian 18101152610662</li>
                              <li>P.Oscar Sitanggang 18101152610657</li>
                          </ul>
                          Saya mohon kesedian Bapak/Ibuk dan saudara untuk mengisi kuesioner ini secara lengkap.
                          Informasi yang diterima dari hasil kuesioner ini bersifat rahasia dan dipergunakan untuk
                          kepentingan akademis. <br> Atas perhatian dan kerjasamanya saya ucapkan terimakasih.
                          </p>
                      </div>
                  </div>
              </div>

              <form method="post">
                  <div class="form-group row">
                      <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap <span
                              class="text-danger">*</span></label>
                      <div class="col-sm-4">
                          <input type="text" name="nama" class="form-control" id="nama" maxlength="45"
                              placeholder="Contoh : Budi Utama" required>
                      </div>
                  </div>

                  <div class="form-group row mt-3">
                      <label for="inputPassword" class="col-sm-2 col-form-label">Jenis Kelamin <span
                              class="text-danger">*</span></label>
                      <div class="col-sm-4">
                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="jk" id="laki" value="L">
                              <label class="form-check-label" for="laki">
                                  Laki-laki
                              </label>
                          </div>

                          <div class="form-check">
                              <input class="form-check-input" type="radio" name="jk" id="perempuan" value="P">
                              <label class="form-check-label" for="perempuan">
                                  Perempuan
                              </label>
                          </div>

                      </div>
                  </div>

                  <div class="form-group row mt-3">
                      <label for="Usia" class="col-sm-2 col-form-label">Usia <span class="text-danger">*</span></label>
                      <div class="col-sm-4">
                          <input type="number" name="umur" class="form-control" id="Usia" placeholder="Contoh : 25"
                              required>
                      </div>
                  </div>

                  <div class="form-group row mt-3">
                      <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan <span
                              class="text-danger">*</span></label>
                      <div class="col-sm-4">
                          <div class="form-group">
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
                      </div>
                  </div>

                  <div class="form-group row mt-3">
                      <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan <span
                              class="text-danger">*</span></label>
                      <div class="col-sm-4">
                          <div class="form-group">
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
                      </div>
                  </div>

                  <div class="form-group row mt-3">
                      <label class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-10">
                          <div class="form-group col-md-4">
                              <button type="submit" name="onuser" class="btn btn-primary"><i
                                      class="bi bi-arrow-right"></i> Lanjutkan</button>
                          </div>
                      </div>
                  </div>


              </form>

              <?php
        } else {
          // ada session, tampilkan pertanyaan
          $userKode = $_SESSION['startResponden'];
          $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM customer WHERE user_kode='$userKode' "));


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
   window.location='?/=start';
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
              session_destroy();
              echo " <script>
       alert('Termakasih Jawaban anda telah dikirim');
   window.location='./';
 </script>";
            }
          }
          ?>



              <?php
        }

        ?>


              <?php
        // saai tpmbol lanjutkan di klik
        if (isset($_POST['onuser'])) {
          $time = time();
          $nama = addslashes($_POST['nama']);
          $jk   = addslashes($_POST['jk']);
          $usia = addslashes($_POST['umur']);
          $pddk = $_POST['pddk'];
          $pkj  = $_POST['pkj'];
          $userKode = base64_encode($time);
          if ($nama == '' || $jk == '' || $usia == '' || $pddk == '' || $pkj == '') {
            echo " <script>
   alert('Identitas Responden Wajib diisi');
   window.location='?/=start';
 </script>";
          } else {
            // echo 'lanjutkan';
            $simpanResponden = mysqli_query($con, "INSERT INTO `customer`(`user_kode`,`nama`, `jk`, `usia`, `education_id`, `job_id`) VALUES ('$userKode','$nama','$jk','$usia','$pddk','$pkj')");
            if ($simpanResponden) {
              $_SESSION['startResponden'] = $userKode;
              echo " <script>
    alert('Lanjutkan');
    window.location='?/=start';
    </script>";
            } else {
              echo " <script>
    alert('Gagal Membuat Data Responden');
    window.location='?/=start';
    </script>";
            }
          }
        }
        ?>

          </div>
      </section>
  </main>

  <!-- End #main -->