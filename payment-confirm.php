<?php include_once '_header.php'; ?>
<?php
if (isset($_SESSION['pelanggan'])) {
    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM customer WHERE id=$_SESSION[pelanggan] "));
    // get data Pembelian
    $user_id = intval($_SESSION['pelanggan']);
    $id_pembelian = intval(base64_decode($_GET['/']));
    $get_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE id=$id_pembelian AND user_id=$user_id ");
    if (mysqli_num_rows($get_cart) < 1) {
        echo "<script>location='shop.php';</script>";
    } else {
        $cart = mysqli_fetch_assoc($get_cart);
    }


?>
<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">

</div>
<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header">
                        <b><i class="fa fa-check-circle"></i> Konfirmasi Pembayaran</b>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            Jumlah Tagihan Anda : <b>Rp. <?= number_format($cart['jumlah_total']) ?></b>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_beli" value="<?= $id_pembelian ?>">
                            <input type="hidden" name="kode" value="<?= $cart['kode'] ?>">
                            <div class="form-group">
                                <label>No.Rekening</label>
                                <input type="number" name="norek" class="form-control" required
                                    placeholder="***************">
                            </div>
                            <div class="form-group">
                                <label>Nama Penyetor</label>
                                <input type="text" name="nm_penyetor" class="form-control" required
                                    placeholder="Contoh : Briliant Adam El-fathan">
                            </div>
                            <div class="form-group">
                                <label>Bank</label>
                                <input type="text" name="bank" class="form-control" required placeholder="Contoh : BRI">
                            </div>
                            <div class="form-group">
                                <label>Waktu Transfer (d/m/Y H:i:s)</label>
                                <input type="text" name="wkt_transfer" class="form-control" required
                                    placeholder="Contoh : 30/01/2022 22:30:00">
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="text" name="jml_transfer" class="form-control" required
                                    value="<?= $cart['jumlah_total'] ?>">
                            </div>

                            <div class="form-group mt-2">
                                <label>Bukti Transfer</label> <br>
                                <input type="file" name="file" required>
                                <br>
                                <em class="text-danger">
                                    Bukti transfer berformat JPG/JPEG/PNG Maksimal 2 MB
                                </em>
                            </div>
                            <div class="form-group mt-2">
                                <button onclick="return confirm('Apakah Yakin Mengirim bukti pembayaran?')"
                                    type="submit" name="confirm" class="btn btn-primary"><i
                                        class="fa fa-chevron-circle-up"></i> Upload Bukti
                                    Pembayaran</button>
                            </div>
                        </form>
                        <?php
                            if (isset($_POST['confirm'])) {
                                $allowed_ext = array('jpg', 'jpeg', 'png', 'pdf');
                                $file_name   = $_FILES['file']['name'];
                                @$file_ext   = strtolower(end(explode('.', $file_name)));
                                $file_size   = $_FILES['file']['size'];
                                $file_tmp    = $_FILES['file']['tmp_name'];

                                $kodefile    = $_POST['kode'] . '-' . time();
                                $id_pembelian = $_POST['id_beli'];
                                $norek = $_POST['norek'];
                                $nm_penyetor = $_POST['nm_penyetor'];
                                $bank = $_POST['bank'];
                                $wkt_transfer = $_POST['wkt_transfer'];
                                $jml_transfer = $_POST['jml_transfer'];
                                $dok = $kodefile . '.' . $file_ext;
                                if (in_array($file_ext, $allowed_ext) === true) {
                                    if ($file_size < 3044070) {
                                        $lokasi = './files/' . $kodefile . '.' . $file_ext;
                                        move_uploaded_file($file_tmp, $lokasi);
                                        $in = mysqli_query($con, "INSERT INTO 
                                        `bukti_pembayaran`(`id_belanja`,`metode_bayar`, `wkt_bayar`, `nm_penyetor`, `bank`, `norek`,`jml_transfer`, `bukti`) 
                                        VALUES ('$id_pembelian','TRANSFER','$wkt_transfer','$nm_penyetor','$bank','$norek','$jml_transfer','$dok')");
                                        if ($in) {
                                            // UPDATE STATUS pemebelian 
                                            mysqli_query($con, "UPDATE `cart` SET `status`='Bukti Pembayaran Telah Dikirim' WHERE id=$id_pembelian");

                                            echo "<script>
                                                alert('Bukti pembayaran berhasil di upload');
                                                location='invoice.php?/=" . $_GET['/'] . " ';
                                                </script>";
                                        } else {
                                            // $msg = ['error' => 'Gagal Mengunggah File'];
                                            echo "<script>
                                                alert('Gagal Mengunggah File');
                                                </script>";
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger'>Besar ukuran file (file size) maksimal 2 Mb!</div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger'>Ekstensi file tidak di izinkan!</div>";
                                }
                            }
                            ?>


                    </div>
                </div>



            </div>

        </div>
    </div>
</section>
<?php
} else {
    echo "<script>location='login.php';</script>";
}

?>



<?php include_once '_footer.php'; ?>