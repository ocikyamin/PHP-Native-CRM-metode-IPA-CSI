<?php include_once '_header.php'; ?>
<?php
if (isset($_SESSION['pelanggan'])) {
    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM customer WHERE id=$_SESSION[pelanggan] "));

?>
<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Detail Pembelian</h1>
        <p>
            Proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            Lorem ipsum dolor sit amet.
        </p>
    </div>
</div>
<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-2">
                    <div class="card-header">

                        <p>
                        <div class="row">
                            <div class="col-lg-4">

                                <ul style="list-style:none">
                                    <li>
                                        <h4><i class="fa fa-cart-arrow-down"></i> Pembelian</h4>
                                    </li>
                                    <li>Kode Pembelian : <b><?= time() ?></b></li>
                                    <li>Tgl.Transaksi : <?= date('d/m/Y') ?></li>
                                    <li>Total Belanja : Rp. <?= number_format($totalBelanja) ?></li>
                                </ul>
                            </div>
                            <div class="col-lg-4">

                                <ul style="list-style:none">
                                    <li>
                                        <h4><i class="fa fa-user"></i> Pelanggan</h4>
                                    </li>
                                    <li><b>Abdul Yamin</b></li>
                                    <li>ocikyamin93@gmail.com</li>
                                    <li>082214607669</li>
                                </ul>
                            </div>
                            <div class="col-lg-4">

                                <ul style="list-style:none">
                                    <li>
                                        <h4><i class="fas fa-map-marker-alt"></i> Alamat</h4>
                                    </li>
                                    <li>Kode Pembelian : <b>B00111</b></li>
                                    <li>Tgl.Transaksi : 10 May 2022</li>
                                    <li>Total Belanja : Rp. 233999,9999</li>
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
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include "../env.php";
                                        $totalBelanja = 0;
                                        foreach ($_SESSION['cart'] as $id => $jumlah) {
                                            $produk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tm_produk WHERE id=$id "));
                                            $subTotal = $produk['harga'] * $jumlah;
                                        ?>
                                    <tr>
                                        <td>
                                            <form method="post">
                                                <input type="hidden" name="id" value="<?= $id ?>">
                                                <button type="submit" name="del" class="btn btn-danger btn-sm"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                        <td> <?= $produk['nm_produk'] ?> </td>
                                        <td>Rp. <?= number_format($produk['harga']) ?></td>
                                        <td align="center">
                                            <?= $jumlah ?>
                                            <!-- <p><a href="" class="btn btn-danger btn-sm">-</a> <a href=""
                                                 class="btn btn-success btn-sm">+</a></p> -->

                                        </td>
                                        <td>Rp. <?= number_format($subTotal) ?></td>

                                    </tr>

                                    <?php
                                            $totalBelanja += $subTotal;
                                        } ?>
                                </tbody>
                            </table>
                            <p>
                                <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-file-alt"></i>
                                    Invoice</a>

                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-check"></i>
                                    Konfirmasi Pembayaran</a>
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