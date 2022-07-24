<?php include_once '_header.php';
$qryProduk = mysqli_query($con, "SELECT * FROM tm_produk ORDER BY id ASC");

// tambahkan ke reanjang belanja 

if (isset($_GET['v'])) {
    $idProduk = base64_decode($_GET['v']);
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
    location='shop.php';
    </script>";
        } else {
            if (isset($_SESSION['cart'][$idProduk])) {
                $_SESSION['cart'][$idProduk]++;
                // mysqli_query($con, "UPDATE `tm_produk` SET `jml_stok`=jml_stok-1 WHERE id=$idProduk ");
            } else {
                $_SESSION['cart'][$idProduk] = 1;
                // mysqli_query($con, "UPDATE `tm_produk` SET `jml_stok`=jml_stok-1 WHERE id=$idProduk ");
            }
        }


        echo "
    <script>
    alert('Produk ditambahkan Ke Keranjang Belanja');
    location='cart.php';
    </script>";
    }
}
?>
<!-- Start Content -->
<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-inline shop-top-menu pb-3 pt-1">
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3" href="#">All Product</a>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="row">
                <?php
                foreach ($qryProduk as $p) {
                ?>
                <div class="col-md-4">
                    <div class="card mb-4 product-wap rounded-0">
                        <div class="card rounded-0">
                            <img class="card-img rounded-0 img-fluid img-thumbnail" style="height:420px;width:414px;"
                                src="./public/product/<?= $p['gambar'] ?>">
                            <div
                                class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                <ul class="list-unstyled">
                                    <!-- <li><a class="btn btn-success text-white" href="shop-single.html"><i
                                                class="far fa-heart"></i></a></li> -->
                                    <li><a class="btn btn-success text-white mt-2"
                                            href="product-detail.php?/=<?= base64_encode($p['id']) ?>"><i
                                                class="far fa-eye"></i></a></li>
                                    <li><a class="btn btn-success text-white mt-2"
                                            href="?v=<?= base64_encode($p['id']) ?>"><i
                                                class="fas fa-cart-plus"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="product-detail.php?/=<?= base64_encode($p['id']) ?>"
                                class="h3 text-decoration-none"><?= $p['nm_produk'] ?></a>
                            <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                <li><?= $p['kode'] ?></li>
                                <li class="pt-2">
                                    <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                    <span
                                        class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                    <span
                                        class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                    <span
                                        class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                    <span
                                        class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                </li>
                            </ul>
                            <ul class="list-unstyled d-flex justify-content-center mb-1">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                            </ul>
                            <p class="text-center mb-0">
                                <b><?= 'Rp, ', number_format($p['harga'], 0) ?> </b>
                            </p>
                        </div>
                    </div>
                </div>

                <?php
                }

                ?>

            </div>

        </div>

    </div>
</div>
<!-- End Content -->

<!-- Start Brands -->

<!--End Brands-->



<?php include_once '_footer.php';