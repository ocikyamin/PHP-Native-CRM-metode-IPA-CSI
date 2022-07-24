<?php include_once '_header.php'; ?>

<?php
if (isset($_SESSION['pelanggan'])) {
    $user_id = intval($_SESSION['pelanggan']);
    $id_pembelian = intval(base64_decode($_GET['/']));



?>
<!-- Start Section -->
<section class="container py-5">
    <div class="row text-center pt-5 pb-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Riwayat Transaksi</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-sm table-hover mid">
                    <thead>
                        <tr>
                            <th>
                                <i class="fa fa-list"></i>
                            </th>
                            <th>Invoice</th>
                            <th>Tgl.Transasksi</th>
                            <th>Total Belanja</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $totalBelanja = 0;
                            $no = 1;
                            $history = mysqli_query($con, "SELECT * FROM `cart` WHERE user_id=$user_id ");
                            foreach ($history as $s) {
                            ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <a href="./invoice.php?/=<?= base64_encode($s['id']) ?>"
                                    class="btn btn-light shadow-sm"><i class="fa fa-file-alt"></i>
                                    <?= $s['kode'] ?></a>

                            </td>
                            <td> <?= date('d/m/Y H:i:s', strtotime($s['wkt'])) ?> </td>
                            <td>Rp. <?= number_format($s['jumlah_total']) ?></td>
                            <td>
                                <?php
                                        if ($s['status'] == 'new') {
                                            echo "<span class='badge rounded-pill bg-warning text-dark'>Belum Konfirmasi Pembayaran</span>";
                                        } else {
                                            echo "<span class='badge rounded-pill bg-secondary'>" . $s['status'] . "</span>";
                                        }

                                        ?>
                            </td>

                        </tr>

                        <?php
                                $totalBelanja += $s['jumlah_total'];
                            } ?>
                        <!-- <tr>
                            <td colspan="3" align="right">
                                Jumlah Belanja :
                            </td>
                            <td><b> Rp.
                                    <?= number_format($totalBelanja) ?></b></td>
                          
                        </tr> -->
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</section>
<!-- End Section -->
<?php
} else {
    echo "<script>location='login.php';</script>";
}

?>

<?php include_once '_footer.php'; ?>