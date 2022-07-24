<div class="pagetitle">
    <h1>Pembayaran</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item">Masters</li>
            <li class="breadcrumb-item active">Pembayaran</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List Produk</h5>
                    <div class="table-responsive">
                        <table class="table datatable table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Tgl.Konfirmasi</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nob = 1;
                                $bukti = mysqli_query($con, "SELECT bukti_pembayaran.*,cart.id AS id_pembelian,cart.kode,cart.wkt,cart.jumlah_total FROM `bukti_pembayaran` JOIN cart ON bukti_pembayaran.id_belanja=cart.id ORDER BY bukti_pembayaran.id ASC");
                                foreach ($bukti as $b) { ?>
                                <tr>
                                    <td><?= $nob++ ?></td>
                                    <td><a
                                            href="?/=invoice&q=<?= base64_encode($b['id_belanja']) ?>"><b><?= $b['kode'] ?></b></a>
                                    </td>
                                    <td><?= $b['wkt_konfirmasi'] ?></td>
                                    <td>
                                        <form method="post">
                                            <!-- <a href="../files/<?= $b['bukti'] ?>" target="_blank"
                                                class="btn btn-light shadow"><i class="bi bi-file"></i>
                                                <?= $b['bukti'] ?></a> -->
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#view-<?= $b['id'] ?>"
                                                class="btn btn-primary shadow"><i class="bi bi-check-circle"></i>
                                                Konfirmasi
                                            </a>
                                            <?php
                                                if ($b['stt_bukti'] == 'no') {
                                                ?>
                                            <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                            <input type="hidden" name="oldimg" value="<?= $b['bukti'] ?>">
                                            <button type="submit" name="del" class="btn btn-danger shadow"><i
                                                    class="bi bi-trash"></i>

                                            </button>
                                            <?php
                                                }

                                                ?>
                                        </form>


                                        <!-- Modal -->
                                        <div class="modal fade" id="view-<?= $b['id'] ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-fullscreen">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><i
                                                                class="bi bi-check-circle"></i> Konfirmasi
                                                            Bukti Pembayaran
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>


                                                    </div>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id_bukti" value="<?= $b['id'] ?>">
                                                        <input type="hidden" name="id_beli"
                                                            value="<?= $b['id_pembelian'] ?>">
                                                        <div class="modal-body">
                                                            <div class="alert alert-info">
                                                                <ul style="list-style:none">
                                                                    <li><b>INVOICE : <?= $b['kode'] ?></b></li>
                                                                    <li>Tgl.Transaksi :
                                                                        <?= date('d/m/Y', strtotime($b['wkt'])) ?>
                                                                    </li>
                                                                    <li>Total Belanja : Rp.
                                                                        <?= number_format($b['jumlah_total']) ?>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td>Wkt. Konfirmasi</td>
                                                                    <td>:</td>
                                                                    <td><?= $b['wkt_konfirmasi'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama Penyetor</td>
                                                                    <td>:</td>
                                                                    <td><?= $b['nm_penyetor'] ?></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>BANK</td>
                                                                    <td>:</td>
                                                                    <td><?= $b['bank'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Wkt.Transaksi</td>
                                                                    <td>:</td>
                                                                    <td><?= $b['wkt_bayar'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jumlah Transfer</td>
                                                                    <td>:</td>
                                                                    <td>Rp.<?= number_format($b['jml_transfer']) ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Lampiran</td>
                                                                    <td>:</td>
                                                                    <td><a href="../files/<?= $b['bukti'] ?>"
                                                                            target="_blank"
                                                                            class="btn btn-light shadow-sm"><i
                                                                                class="bi bi-file"></i>
                                                                            <?= $b['bukti'] ?></a></td>
                                                                </tr>



                                                            </table>

                                                            <p>
                                                            <div class="form-group">
                                                                <label>Keterangan</label>
                                                                <textarea name="ket" rows="6" class="form-control"
                                                                    placeholder="Tuliskan Keterangan"></textarea>
                                                            </div>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="tolak" class="btn btn-danger">
                                                                <i class="bi bi-x-circle"></i>
                                                                Tolak Bukti
                                                                Pembayaran</button>
                                                            <button type="submit" name="terima" class="btn btn-primary">
                                                                <i class="bi bi-check2-all"></i>
                                                                Terima Bukti
                                                                Pembayaran</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                            if ($b['stt_bukti'] == 'new') {
                                                echo "<span class='badge rounded-pill bg-warning text-dark'>Belum Konfirmasi</span>";
                                            } else if ($b['stt_bukti'] == 'ok') {
                                                echo "<span class='badge rounded-pill bg-success'>Diterima</span>";
                                            } else {
                                                echo "<span class='badge rounded-pill bg-danger'>Ditolak</span>";
                                            }

                                            ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>


    </div>
</section>
<?php
if (isset($_POST['terima'])) {
    $id_beli = $_POST['id_beli'];
    $id = $_POST['id_bukti'];
    $ket = $_POST['ket'];
    mysqli_query($con, "UPDATE `bukti_pembayaran` SET `ket`='$ket',`stt_bukti`='ok' WHERE id=$id");
    mysqli_query($con, "UPDATE `cart` SET `status`='Bukti Pembayaran Telah Diterima, Pesanan Anda akan segera dikirim',`stt_transaksi`=1 WHERE id=$id_beli");
    echo "<script>location='?/=pembayaran';</script>";
}

if (isset($_POST['tolak'])) {
    $id_beli = $_POST['id_beli'];
    $id = $_POST['id_bukti'];
    $ket = $_POST['ket'];
    if ($ket == "") {
        echo "<script>alert('Harap Beri Keterangan Kenapa Bukti Pembayaran Ditolak.')</script>";
    } else {

        mysqli_query($con, "UPDATE `bukti_pembayaran` SET `ket`='$ket',`stt_bukti`='no' WHERE id=$id");
        mysqli_query($con, "UPDATE `cart` SET `status`='Bukti Pembayaran Telah Dikonfirmasi, namun bukti pembayaran ditolak',`stt_transaksi`=0 WHERE id=$id_beli");
        echo "<script>location='?/=pembayaran';</script>";
    }
}

// delete record
if (isset($_POST['del'])) {
    $id = intval($_POST['id']);
    $oldImg = $_POST['oldimg'];

    $delete = mysqli_query($con, "DELETE FROM `bukti_pembayaran` WHERE id=$id ");
    if ($delete) {
        $fimg = '../files/' . $oldImg;
        unlink("$fimg");
        echo "<script>
alert('Deleted Suscess');
location='?/=pembayaran';
</script> ";
    }
}

?>