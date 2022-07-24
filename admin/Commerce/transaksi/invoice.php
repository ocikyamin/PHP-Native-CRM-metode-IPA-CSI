<div class="pagetitle">
    <h1>Invoice</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">E-Commerce</li>
            <li class="breadcrumb-item active">Invoice</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<?php
if (isset($_GET['q'])) {
    // get data Pembelian

    $id_pembelian = intval(base64_decode($_GET['q']));
    $get_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE id=$id_pembelian");
    if (mysqli_num_rows($get_cart) < 1) {
        echo "<script>location='./';</script>";
    } else {
        $cart = mysqli_fetch_assoc($get_cart);
        $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM customer WHERE id=$cart[user_id] "));
    }


?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-2 shadow">
                <div class="card-header" style="border-bottom: 2px dotted;">

                    <p>
                    <div class="row">
                        <div class="col-lg-4">

                            <ul style="list-style:none">
                                <li>
                                    <h4><i class="bi bi-cart4"></i> Pembelian</h4>
                                </li>
                                <li><b>INVOICE : <?= $cart['kode'] ?></b></li>
                                <li>Tgl.Transaksi : <?= date('d/m/Y', strtotime($cart['wkt'])) ?></li>
                                <li>Total Belanja : Rp. <?= number_format($cart['jumlah_total']) ?></li>
                            </ul>
                        </div>
                        <div class="col-lg-4">

                            <ul style="list-style:none">
                                <li>
                                    <h4><i class="bi bi-person"></i> Pelanggan</h4>
                                </li>
                                <li><b><?= $user['nama'] ?></b></li>
                                <li><?= $user['user_email'] ?></li>
                                <li><?= $user['user_hp'] ?></li>
                            </ul>
                        </div>
                        <div class="col-lg-4">

                            <ul style="list-style:none">
                                <li>
                                    <h4><i class="bi bi-geo-alt-fill"></i> Alamat</h4>
                                </li>
                                <li>Provinsi : <b><?= $user['prov'] ?></b></li>
                                <li>Kab : <?= $user['kab'] ?></li>
                                <li>Alamat : <?= $user['alamat'] ?></li>
                            </ul>
                        </div>
                    </div>
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-hover mid">
                            <thead>
                                <tr>
                                    <th>
                                        <i class="fa fa-list"></i>
                                    </th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $totalBelanja = 0;
                                    $no = 1;
                                    $produk = mysqli_query($con, "SELECT tm_produk.kode, tm_produk.nm_produk, tm_produk.gambar, cart_detail.harga_beli, cart_detail.jumlah, cart_detail.sub_total FROM `cart_detail` JOIN tm_produk ON cart_detail.produk_id=tm_produk.id WHERE cart_detail.cart_id=$id_pembelian ORDER BY cart_detail.id ASC ");
                                    foreach ($produk as $s) {
                                    ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td> <?= $s['nm_produk'] ?> </td>
                                    <td>Rp. <?= number_format($s['harga_beli']) ?></td>
                                    <td><?= $s['jumlah'] ?></td>
                                    <td>Rp. <?= number_format($s['sub_total']) ?></td>

                                </tr>

                                <?php
                                        $totalBelanja += $s['sub_total'];
                                    } ?>
                                <tr>
                                    <td colspan="4" align="right">
                                        Jumlah Belanja :
                                    </td>
                                    <td><b> Rp.
                                            <?= number_format($totalBelanja) ?></b></td>
                                </tr>
                            </tbody>
                        </table>

                        <p>
                        <div class="alert alert-default shadow-sm">
                            STATUS : <?php
                                            if ($cart['status'] == 'new') {
                                                echo "<span class='badge rounded-pill bg-warning text-dark'>Belum Konfirmasi Pembayaran</span>";
                                            } else {
                                                echo "<span class='badge rounded-pill bg-secondary'>" . $cart['status'] . "</span>";
                                            }

                                            ?>
                        </div>
                        <?php
                            $bukti = mysqli_query($con, "SELECT * FROM `bukti_pembayaran` WHERE id_belanja=$id_pembelian");
                            if (mysqli_num_rows($bukti) > 0) {
                            ?>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl.Konfirmasi</th>
                                        <th>Bukti Pembayaran</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            $nob = 1;
                                            foreach ($bukti as $b) { ?>
                                    <tr>
                                        <td><?= $nob++ ?></td>
                                        <td><?= $b['wkt_konfirmasi'] ?></td>
                                        <td>
                                            <form method="post">
                                                <!-- <a href="../files/<?= $b['bukti'] ?>" target="_blank"
                                                class="btn btn-light shadow"><i class="bi bi-file"></i>
                                                <?= $b['bukti'] ?></a> -->
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#view-<?= $b['id'] ?>"
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
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>


                                                        </div>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id_bukti"
                                                                value="<?= $b['id'] ?>">
                                                            <input type="hidden" name="id_beli"
                                                                value="<?= $id_pembelian ?>">
                                                            <div class="modal-body">
                                                                <div class="alert alert-info">
                                                                    <ul style="list-style:none">
                                                                        <li><b>INVOICE : <?= $cart['kode'] ?></b></li>
                                                                        <li>Tgl.Transaksi :
                                                                            <?= date('d/m/Y', strtotime($cart['wkt'])) ?>
                                                                        </li>
                                                                        <li>Total Belanja : Rp.
                                                                            <?= number_format($cart['jumlah_total']) ?>
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
                                                                <button type="submit" name="tolak"
                                                                    class="btn btn-danger">
                                                                    <i class="bi bi-x-circle"></i>
                                                                    Tolak Bukti
                                                                    Pembayaran</button>
                                                                <button type="submit" name="terima"
                                                                    class="btn btn-primary">
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

                        <?php
                            }

                            ?>

                        <form action="../print/invoice-print.php" method="post" target="_blank">
                            <input type="hidden" name="id" value="<?= $id_pembelian ?>">
                            <button type="submit" name="print_invoice" class="btn btn-warning"><i
                                    class="bi bi-receipt"></i>
                                Print Invoice</button>

                            <!-- <a href="./payment-confirm.php?/=<?= base64_encode($id_pembelian) ?>"
                                class="btn btn-primary btn-sm"><i class="fa fa-check"></i>
                                Konfirmasi Pembayaran</a> -->
                        </form>
                        </p>
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
        mysqli_query($con, "UPDATE `cart` SET `status`='Bukti Pembayaran Telah Diterima, Pesanan Anda akan segera dikirim' WHERE id=$id_beli");
        echo "<script>location='?/=invoice&q=" . base64_encode($id_pembelian) . " ';</script>";
    }

    if (isset($_POST['tolak'])) {
        $id_beli = $_POST['id_beli'];
        $id = $_POST['id_bukti'];
        $ket = $_POST['ket'];
        if ($ket == "") {
            echo "<script>alert('Harap Beri Keterangan Kenapa Bukti Pembayaran Ditolak.')</script>";
        } else {

            mysqli_query($con, "UPDATE `bukti_pembayaran` SET `ket`='$ket',`stt_bukti`='no' WHERE id=$id");
            mysqli_query($con, "UPDATE `cart` SET `status`='Bukti Pembayaran Telah Dikonfirmasi' WHERE id=$id_beli");
            echo "<script>location='?/=invoice&q=" . base64_encode($id_pembelian) . " ';</script>";
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
location='?/=invoice&q=" . base64_encode($id_pembelian) . " ';
</script> ";
        }
    }

    ?>
<?php
} else {
    echo "<script>location='?/=transaksi';</script>";
}

?>