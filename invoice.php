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
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">INVOICE <br>
            <b><?= $cart['kode'] ?></b>
        </h1>
    </div>
</div>
<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-2 shadow">
                    <div class="card-header" style="border-bottom: 2px dotted;">

                        <p>
                        <div class="row">
                            <div class="col-lg-4">

                                <ul style="list-style:none">
                                    <li>
                                        <h4><i class="fa fa-cart-arrow-down"></i> Pembelian</h4>
                                    </li>
                                    <li><b>INVOICE : <?= $cart['kode'] ?></b></li>
                                    <li>Tgl.Transaksi : <?= date('d/m/Y', strtotime($cart['wkt'])) ?></li>
                                    <li>Total Belanja : Rp. <?= number_format($cart['jumlah_total']) ?></li>
                                </ul>
                            </div>
                            <div class="col-lg-4">

                                <ul style="list-style:none">
                                    <li>
                                        <h4><i class="fa fa-user"></i> Pelanggan</h4>
                                    </li>
                                    <li><b><?= $user['nama'] ?></b></li>
                                    <li><?= $user['user_email'] ?></li>
                                    <li><?= $user['user_hp'] ?></li>
                                </ul>
                            </div>
                            <div class="col-lg-4">

                                <ul style="list-style:none">
                                    <li>
                                        <h4><i class="fas fa-map-marker-alt"></i> Alamat</h4>
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
                            <div class="alert alert-info">
                                <ul style="list-style: none;">
                                    <li><b>SISTEM TRANSFER</b></li>
                                    <ul>
                                        <li>Anda harus membayar dengan cara transfer Sejumlah <b> Rp.
                                                <?= number_format($totalBelanja) ?></b> ke salah satu Rekening dibawah
                                            ini.</li>
                                        <li>
                                            <b>BRI
                                                Norek : 787301003830533 / AN : Susi Rahmatul Fitri
                                            </b>
                                        </li>
                                        <li>
                                            <b>MANDIRI
                                                Norek : 65322232 / AN : Mulyadi
                                            </b>
                                        </li>
                                        <li>Setelah anda melakukan Pembayaran, Konfirmasi pembayaran kepda admin kami /
                                            melalui tombol Konfirmasi Pembayaran. Setelah Konfirmasi pembayaran valid
                                            kami akan mengirimkan pesanan anda.</li>
                                    </ul>
                                    <li><b>PEMBAYARAN TUNAI</b></li>
                                    <ul>
                                        <li>Untuk anda yang berada di wilayah bukittinggi dan sekitarnya Sistem
                                            pembayaran bisa lansung atau kami jemput sekaligus mengantar pesanan anda /
                                            COD (Cash On Delivery)
                                        </li>
                                    </ul>
                                </ul>
                            </div>
                            </p>
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
                                <table class="table table-sm mid">
                                    <thead>
                                        <tr>
                                            <th>No</th>
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
                                            <td>
                                                <!-- <form method="post">
                                                    <?php
                                                    if ($b['stt_bukti'] == 'no') {
                                                    ?>
                                                    <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                                    <input type="hidden" name="oldimg" value="<?= $b['bukti'] ?>">
                                                    <button type="submit" name="del" class="btn 787301003830533 / AN : Susi Rahmatul Fitri
MANDIRI Norek : 65322232 / AN : Mulyadi
Setelah anda melakukan Pembayaran, Konfirmasi pembayaran kepda admin kami / melalui tombol Konfirmasi
Pembayaran. Setelah Konfirmbtn-danger shadow"><i787301003830533 / AN : Susi Rahmatul Fitri
MANDIRI Norek : 65322232 / AN : Mulyadi
Setelah anda melakukan Pembayaran, Konfirmasi pembayaran kepda admin kami / melalui tombol Konfirmasi
Pembayaran. Setelah Konfirm
                                                            class="fa fa-trash"></i787301003830533>

                                                    </button>
                                                    <?php
                                                    }

                                                    ?>
                                                </form> -->
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
                                                        <td><a href="./files/<?= $b['bukti'] ?>" target="_blank"
                                                                class="btn btn-light shadow-sm"><i
                                                                    class="bi bi-file"></i>
                                                                <?= $b['bukti'] ?></a></td>
                                                    </tr>



                                                </table>


                                            </td>
                                            <td>
                                                <?php
                                                            if ($b['stt_bukti'] == 'new') {
                                                                echo "<span class='badge rounded-pill bg-warning text-dark'>Belum Konfirmasi</span>";
                                                            } else if ($b['stt_bukti'] == 'ok') {
                                                                echo "<span class='badge rounded-pill bg-success'>Diterima</span>";
                                                            } else {
                                                                echo "<span class='badge rounded-pill bg-danger'>Ditolak</span>";
                                                                echo "<span class='badge bg-danger'>" . $b['ket'] . "</span>";
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

                            <form action="invoice-print.php" method="post" target="_blank">
                                <input type="hidden" name="id" value="<?= $id_pembelian ?>">
                                <button type="submit" name="print_invoice" class="btn btn-warning"><i
                                        class="fa fa-file-alt"></i>
                                    Print Invoice</button>

                                <a href="./payment-confirm.php?/=<?= base64_encode($id_pembelian) ?>"
                                    class="btn btn-primary btn-sm"><i class="fa fa-check"></i>
                                    Konfirmasi Pembayaran</a>
                            </form>
                            </p>
                        </div>

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