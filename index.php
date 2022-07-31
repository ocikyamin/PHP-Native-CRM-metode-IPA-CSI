<?php include_once '_header.php';
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

        if (isset($_SESSION['cart'][$idProduk])) {
            $_SESSION['cart'][$idProduk]++;
            // mysqli_query($con, "UPDATE `tm_produk` SET `jml_stok`=jml_stok-1 WHERE id=$idProduk ");
        } else {
            $_SESSION['cart'][$idProduk] = 1;
            // mysqli_query($con, "UPDATE `tm_produk` SET `jml_stok`=jml_stok-1 WHERE id=$idProduk ");
        }
        echo "
    <script>
    alert('Produk ditambahkan Ke Keranjang Belanja');
    location='cart.php';
    </script>";
    }
}
 ?>
<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="rounded-circle img-fluid border" style="height:420px;width:414px;"
                            src="./public/product/new/008.jpg">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success"><b>Usiusi</b> Interior</h1>
                            <h3 class="h2">Pilihan Gorden Terbaik Untuk Interior Rumah Anda</h3>
                            <p>
                                Selamat Datang di website <a rel="sponsored" class="text-success"
                                    href="https://usiusi.com" target="_blank">Usiusi Interior</a> Bukittinggi.
                                Kami Hadir Untuk Membantu Memenuhi Kebutuhan Interior Rumah Anda
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="rounded-circle img-fluid border" src="./public/product/new/002.jpg"
                            style="height:420px;width:414px;" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Vertical Blind</h1>
                            <h3 class="h2">Produk Unggulan Kami</h3>
                            <p>
                                Vertical Blind merupakan salah satu gorden yang paling sering di digunakan pada bangunan
                                rumah berukuran panjang.

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="rounded-circle img-fluid border" src="./public/product/new/003.jpg"
                            style="height:420px;width:414px;">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Roller Blind</h1>
                            <h3 class="h2">Prduk Unggulan</h3>
                            <p>
                                <b>Roller Blind</b> adalah satu set kain atau plastik yang sangat praktis dalam
                                pengopersian nya dan perawatannya.

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
        role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
        role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->



<!-- Start Categories of The Month -->
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
        // $qry_unggulan = mysqli_query($con, "SELECT * FROM tm_produk WHERE unggulan=1 ORDER BY id ASC");
         $qry_unggulan = mysqli_query($con, "SELECT * FROM tm_produk ORDER BY id ASC");
        foreach ($qry_unggulan as $u) { ?>
        <div class="col-lg-4 col-md-4 p-5">
            <a href="#"><img src="./public/product/<?= $u['gambar'] ?>"
                    style="min-height:300px; min-width:300px;height:300px;width:300px;"
                    class="rounded-circle img-fluid border"></a>
            <h5 class="text-center mt-3 mb-3"><?= $u['nm_produk'] ?> <br> <small>Rp.<?= number_format($u['harga']) ?></small></h5>
            <p class="text-center">
            <a href="product-detail.php?/=<?= base64_encode($u['id']) ?>"
                    class="btn btn-success">
                    Detail</a>
                    <a class="btn btn-warning"
                                            href="?v=<?= base64_encode($u['id']) ?>"><i
                                                class="fas fa-cart-plus"></i></a>
                    </p>
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
<!-- End Categories of The Month -->


<!-- Start Featured Product -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Featured Product</h1>
                <p>
                    Reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="#">
                        <img src="./public/product/new/008.jpg" class="card-img-top img-thumbnail"
                            style="height:420px;width:414px;" alt="...">
                    </a>
                    <div class="card-body">
                        <a href="#" class="h2 text-decoration-none text-dark">Gorden tipis dari vitrase
                            yang tembus cahaya</a>
                        <p class="card-text">
                            Walaupun dalam keadaan tertutup, sinar matahari dapat masuk dengan optimal ke dalam ruangan.
                            Vitrase umumnya digunakan sebagai dasar gorden, namun bisa juga digunakan tanpa pelapis
                            apapun. 
                        </p>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="#">
                        <img src="./public/product/new/003.jpg" class="card-img-top img-thumbnail"
                            style="height:420px;width:414px;" alt="...">
                    </a>
                    <div class="card-body">
                        <a href="#" class="h2 text-decoration-none text-dark">Semi blackout yang nyaman
                            dengan secercah matahari </a>
                        <p class="card-text">
                            Semi blackout adalah gorden dengan tingkat transparansi di antara vitrase dan blackout. Saat
                            gorden tertutup, ruangan masih dapat tersinari matahari secara semu. 
                        </p>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="#">
                        <img src="./public/product/new/005.jpg" class="card-img-top img-thumbnail"
                            style="height:420px;width:414px;" alt="...">
                    </a>
                    <div class="card-body">
                        <a href="#" class="h2 text-decoration-none text-dark">Single panel yang
                            simple</a>
                        <p class="card-text">
                            Karena hanya menggunakan satu gorden, model ini fleksibel untuk dibuka ke arah kanan ataupun
                            kiri. Tipe ini cocok untuk ruangan kecil.
                        </p>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Featured Product -->
<?php include_once '_footer.php'; ?>