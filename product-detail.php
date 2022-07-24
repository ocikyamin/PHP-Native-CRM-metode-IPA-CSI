<?php include_once '_header.php'; ?>
<?php
if (isset($_GET['/'])) {
    $id_produk = intval(base64_decode($_GET['/']));
    $produk = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tm_produk WHERE id=$id_produk "));

?>
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="./public/product/<?= $produk['gambar'] ?>" alt="Card image cap"
                        id="product-detail">
                </div>

            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2"><?= $produk['nm_produk'] ?></h1>
                        <p class="h3 py-2">Rp. <?= number_format($produk['harga']) ?></p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Stok:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong><?= $produk['jml_stok'] ?></strong></p>
                            </li>
                        </ul>

                        <h6>Description:</h6>
                        <p>
                            <?= $produk['deskripsi'] ?>
                        </p>


                        <form action="" method="POST">
                            <input type="hidden" name="id_produk" value="<?= $id_produk ?>">
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">
                                            Quantity
                                            <input type="hidden" name="jml" id="product-quanity" value="1">
                                        </li>
                                        <li class="list-inline-item"><span class="btn btn-success"
                                                id="btn-minus">-</span></li>
                                        <li class="list-inline-item">
                                            <span class="badge bg-secondary" id="var-value">1</span>
                                        </li>
                                        <li class="list-inline-item"><span class="btn btn-success"
                                                id="btn-plus">+</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <!-- <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit"
                                        value="buy">Buy</button>
                                </div> -->
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="addtocart"
                                        value="addtocard">Add To Cart</button>
                                </div>
                            </div>
                        </form>

                        <?php
                            if (isset($_POST['addtocart'])) {
                                $jml = intval($_POST['jml']);
                                $id_beli = intval($_POST['id_produk']);
                                $getstok = mysqli_fetch_assoc(mysqli_query($con, "SELECT jml_stok FROM tm_produk WHERE id=$id_beli "));
                                if ($jml > $getstok['jml_stok'] || $getstok['jml_stok'] == 0) {
                                    //  
                                    echo "
                        <script>
                        alert('Mohon Maaf Stok tidak cukup');
                        // location='shop.php';
                        </script>";
                                } else {
                                    $_SESSION['cart'][$id_beli] += $jml;
                                    echo "
                        <script>
                        alert(' $jml Produk ditambahkan Ke Keranjang Belanja');
                        // location='shop.php';
                        </script>";
                                    // echo "berhasil";
                                    // mysqli_query($con, "UPDATE `tm_produk` SET `jml_stok`=jml_stok-$jml WHERE id=$id_beli ");
                                    //             echo "
                                    // <script
                                    // alert('Produk ditambahkan Ke Keranjang Belanja');
                                    // location='cart.php';
                                    // </script>
                                    // ";
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
}
?>

<!-- Open Content -->

<!-- Close Content -->

<?php include_once '_footer.php'; ?>