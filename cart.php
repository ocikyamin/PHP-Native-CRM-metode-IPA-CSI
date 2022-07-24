<?php include_once '_header.php'; ?>
<?php
// echo "<pre>";
// print_r($_SESSION['cart']);
// echo "</pre>";
if (isset($_GET['empty'])) {
    unset($_SESSION['cart']);
    echo "<script>
    alert('Keranjang dikosongkan');
</script>";
}


// tambah produk ke keranjang 
if (isset($_POST['add'])) {
    $idProduk = intval($_POST['id']);
    $getstok = mysqli_fetch_assoc(mysqli_query($con, "SELECT jml_stok FROM tm_produk WHERE id=$idProduk "));
    if ($getstok['jml_stok'] == 0) {
        echo "
    <script>
    alert('Mohon Maaf Produk Sold Out');
    location='shop.php';
    </script>";
    } else {

        if ($_SESSION['cart'][$idProduk] >= $getstok['jml_stok']) {
            echo "
    <script>
    alert('Stok Produk Tidak Mencukupi');
    location='cart.php';
    </script>";
        } else {
            if (isset($_SESSION['cart'][$idProduk])) {

                $_SESSION['cart'][$idProduk]++;
            } else {
                $_SESSION['cart'][$idProduk] = 1;
            }
        }
        echo "
    <script>
    location='cart.php';
    </script>";
    }
}
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
if ($_SESSION['cart']) {
?>
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Keranjang Belanja</h1>
    </div>
</div>
<!-- Open Content -->

<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-9">
                <div class="card mb-2">
                    <div class="card-header" style="border-bottom: 1px dotted;">
                        <?php
                            if (isset($_SESSION['pelanggan'])) {
                                $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM customer WHERE id=$_SESSION[pelanggan] "));

                            ?>
                        <h1 class="h2"><i class="fa fa-fw fa-cart-arrow-down"></i> Keranjang Belanja</h1>

                        <?php
                            } else {
                                echo ' <div class="alert alert-warning mt-3">
                                Harap <a href="login.php">Login</a> terlebih dahulu untuk melakukan checkout
                                </div>';
                            }

                            ?>
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
                                        <th>Qty</th>
                                        <th></th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include "../env.php";
                                        $totalBelanja = 0;
                                        $nom = 1;

                                        foreach ($_SESSION['cart'] as $id => $jumlah) {
                                            $produk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tm_produk WHERE id=$id "));
                                            $oldStok = $produk['jml_stok'];
                                            if ($jumlah > $oldStok) {
                                                $fixjml = $oldStok;
                                            } else {
                                                $fixjml = $jumlah;
                                            }
                                            $subTotal = $produk['harga'] * $fixjml;

                                        ?>
                                    <tr>
                                        <td>
                                            <?= $nom++; ?>

                                            <!-- <form method="post">
                                                <input type="hidden" name="id" value="<?= $id ?>">
                                                <button type="submit" name="del" class="btn btn-danger btn-sm"><i
                                                        class="fa fa-trash"></i></button>
                                            </form> -->

                                        </td>
                                        <td> <a
                                                href="product-detail.php?/=<?= base64_encode($produk['id']) ?>"><?= $produk['nm_produk'] ?></a>
                                        </td>
                                        <td>Rp. <?= number_format($produk['harga']) ?></td>
                                        <td align="center"><?= $jumlah ?>
                                            <?php
                                                    if ($jumlah > $oldStok) {
                                                        echo "<br><span class='badge rounded-pill bg-danger' style='font-size:12px'>Mohon Maaf ! Anda Hanya dapat membeli $oldStok Item saja , karena Stok Produk tidak mencukupi</span>";
                                                    }

                                                    ?>

                                        </td>
                                        <td>
                                            <form method="post" style="display:inline ;">
                                                <input type="hidden" name="id" value="<?= $id ?>">
                                                <button type="submit" name="del1" class="btn btn-warning btn-sm shadow">
                                                    <i class="fa fa-minus"></i></button>
                                            </form>
                                            <form method="post" style="display:inline ;">
                                                <input type="hidden" name="id" value="<?= $id ?>">
                                                <button type="submit" name="add" class="btn btn-primary btn-sm shadow">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>Rp. <?= number_format($subTotal) ?></td>

                                    </tr>

                                    <?php
                                            $totalBelanja += $subTotal;
                                        } ?>
                                </tbody>
                            </table>
                            <p>
                                <a href="./shop.php" class="btn btn-primary btn-xs shadow">
                                    <i class="fas fa-angle-double-left"></i>
                                    Lanjutkan Belanja</a>
                                <a href="./cart.php?empty"
                                    onclick="return confirm('Tindakan ini akan menghapus Semua Produk di Keranjang Belanja ?')"
                                    class="btn btn-danger btn-xs shadow">
                                    <i class="fa fa-trash-alt"></i>
                                    Kosongkan Keranjang</a>
                            </p>
                        </div>

                    </div>
                </div>

            </div>
            <!-- col end -->
            <div class="col-lg-3">
                <div class="card shadow">
                    <div class="card-header" style="border-bottom: 2px blue dashed;">

                        <h1 class="h2"><b> <i class="fas fa-money-check-alt"></i> Total Belanja </b></h1>
                    </div>
                    <div class="card-body text-center">
                        <h1 class="h2">
                            <b>Rp. <?= number_format($totalBelanja) ?></b>
                        </h1>
                        <hr>
                        <div class="d-grid gap-2 mx-auto">
                            <form method="post">
                                <input type="hidden" name="id_user" value="<?= $_SESSION['pelanggan'] ?>">
                                <input type="hidden" name="jml_belanja" value="<?= $totalBelanja ?>">
                                <button name="checkout"
                                    onclick="return confirm('Apakah Anda Yakin Melakukan Checkout ?')"
                                    class="btn btn-primary shadow" type="submit"><i class="fas fa-shopping-cart"></i>
                                    Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    //  hapus produk dari keranjang 
                    if (isset($_POST['del'])) {
                        unset($_SESSION['cart'][$_POST['id']]);
                        echo "<script>location='./cart.php'</script>";
                    }
                    if (isset($_POST['del1'])) {
                        $idProduk = $_POST['id'];
                        $_SESSION['cart'][$idProduk]--;

                        if ($_SESSION['cart'][$idProduk] < 1) {
                            unset($_SESSION['cart'][$idProduk]);
                        }
                        echo "<script>location='./cart.php'</script>";
                    }

                    ?>

                <?php
                    // include 'env.php';
                    // echo "<pre>";
                    // print_r($_SESSION);
                    // echo "</pre>";

                    // unset($_SESSION['pelanggan']);
                    if (isset($_POST['checkout'])) {
                        // Cek sessi user 
                        if (isset($_SESSION['pelanggan'])) {
                            // inset ke cart 
                            $kodeBelanja = 'B-' . time();
                            $userId = $_POST['id_user'];
                            $jml_belanja = $_POST['jml_belanja'];
                            mysqli_query($con, " INSERT INTO `cart`(`user_id`, `kode`, `jumlah_total`) VALUES ('$userId','$kodeBelanja','$jml_belanja') ");
                            $last_id = mysqli_insert_id($con);
                            // insert ke cart_detail
                            foreach ($_SESSION['cart'] as $id_produk => $jml) {
                                $produk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tm_produk WHERE id=$id_produk "));
                                $harga_beli = $produk['harga'];

                                $oldStok = $produk['jml_stok'];
                                if ($jml > $oldStok) {
                                    $fixjml = $oldStok;
                                } else {
                                    $fixjml = $jml;
                                }
                                $subTotal = $produk['harga'] * $fixjml;
                                mysqli_query($con, "INSERT INTO `cart_detail`(`cart_id`, `produk_id`,`harga_beli`,`jumlah`,`sub_total`) VALUES ('$last_id','$id_produk','$harga_beli','$fixjml','$subTotal')");
                                mysqli_query($con, "UPDATE `tm_produk` SET `jml_stok`=jml_stok-$fixjml WHERE id=$id_produk");
                            }
                            // reset session keranjang 
                            unset($_SESSION['cart']);
                            //    buat Nota Pembelian
                    ?>
                <script>
                alert('Checkout Berhasil');
                location = './invoice.php?/=<?= base64_encode($last_id) ?>';
                </script>
                <?php

                        } else {
                            echo " <script>
                    alert('Harap Daftar / Login Terlebih dahulu untuk melakukan Checkout');
                    location='register.php';
                </script>";
                        }
                    }
                    ?>
            </div>
        </div>
    </div>
</section>
<?php
} else {
?>
<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Keranjang Kosong</h1>
        <p>
        <div class="alert alert-warning">
            Belum ada produk di keranjang, klik pada menu Shop untuk jelajahi produk atau klik tautan <a
                href="./shop.php">Lihat Produk ?</a>
        </div>
        </p>
    </div>
</div>
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Produk Unggulan</h1>
            <p>
                Produk unggulan kami siap mendekor ruangan rumah kesayangan anda agar terkesan elegan dan mewah
            </p>
        </div>
    </div>
    <div class="row">
        <?php
            $qry_unggulan = mysqli_query($con, "SELECT * FROM tm_produk WHERE unggulan=1 ORDER BY id ASC");
            foreach ($qry_unggulan as $u) { ?>
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="./public/product/<?= $u['gambar'] ?>"
                    style="min-height:300px; min-width:300px;height:300px;width:300px;"
                    class="rounded-circle img-fluid border"></a>
            <h5 class="text-center mt-3 mb-3"><?= $u['nm_produk'] ?></h5>
            <p class="text-center"><a href="product-detail.php?/=<?= base64_encode($u['id']) ?>"
                    class="btn btn-success">
                    Lihat Produk</a></p>
        </div>

        <?php } ?>
        <!-- <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="././public/front/assets/img/category_img_02.jpg"
                    class="rounded-circle img-fluid border"></a>
            <h2 class="h5 text-center mt-3 mb-3">Shoes</h2>
            <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
        </div>
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="././public/front/assets/img/category_img_03.jpg"
                    class="rounded-circle img-fluid border"></a>
            <h2 class="h5 text-center mt-3 mb-3">Accessories</h2>
            <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
        </div> -->
    </div>
</section>

<?php
}
?>





<?php include_once '_footer.php'; ?>